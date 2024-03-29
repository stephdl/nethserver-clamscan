<template>
  <div>
    <h2>{{$t('quarantine.title')}}</h2>
    <div v-if="!view.isLoaded" class="spinner spinner-lg"></div>
    <div v-if="view.isLoaded">
      <div v-if="quarantine.length === 0 && found.length === 0" >
          <div class="blank-slate-pf">
            <div class="blank-slate-pf-icon">
                <span class="fa fa-lock"></span>
            </div>
            <h1>{{$t('quarantine.No_quarantined_files')}}</h1>
            <p>{{$t('quarantine.no_quarantined_desc')}}.</p>
          </div>
      </div>
      <div v-else>
        <h3>{{(view.Found)?$t('quarantine.list_suspicious_files'):$t('quarantine.list_files_moved_to_quarantine')}}
          <div class="right">
            <button  @click="SwitchView()" class="btn btn-default mg-righ-found" type="submit">
              {{(view.Found) ? $t('quarantine.See_files_moved_in_Quarantine'):$t('quarantine.See_suspicious_files')}}
            </button>
            <span v-if="loadersRecoverAll" class="spinner spinner-sm form-spinner-loader adjust-top-loader"></span>
            <button  @click="RecoverAll()" class="btn btn-primary span-right-margin-recoverAll" type="submit">
              {{$t('quarantine.RecoverAll')}}</button>
          </div>
        </h3>
        <vue-good-table
          v-if="view.isLoaded"
          :customRowsPerPageDropdown="[25,50,100]"
          :perPage="25"
          :columns="(view.Found) ? columnsFound:columns"
          :rows="(view.Found) ? found:quarantine"
          :lineNumbers="false"
          :defaultSortBy="{field: 'path', type: 'asc'}"
          :globalSearch="true"
          :paginate="true"
          styleClass="table"
          :nextText="tableLangsTexts.nextText"
          :prevText="tableLangsTexts.prevText"
          :rowsPerPageText="tableLangsTexts.rowsPerPageText"
          :globalSearchPlaceholder="tableLangsTexts.globalSearchPlaceholder"
          :ofText="tableLangsTexts.ofText"
        >
        <template slot="table-row" slot-scope="props">
          <td class="fancy">
              <strong>{{ props.row.path }}</strong>
          </td>
          <td class="fancy">
              <strong>{{ props.row.ruleMatch }}</strong>
          </td>
          <td>
            <button v-if="!view.Found"
              @click="restore( props.row.path )"
              class="btn btn-default button-minimum"
              >
              <span
              :class="['fa', 'fa-unlock', 'span-right-margin']"
              ></span>
              {{$t('quarantine.Recover') }}
            </button>
          </td>
          <td>
            <button v-if="!view.Found"
              @click="exclude( props.row.path )"
              class="btn btn-default button-minimum"
              >
              <span
              :class="['fa', 'fa-unlock', 'span-right-margin']"
              ></span>
              {{$t('quarantine.Exclude') }}
            </button>
          </td>
        </template>
        </vue-good-table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Unban",
  mounted() {
    this.getQuarantined();
  },
  data() {
    return {
      view: {
        isLoaded: false,
        Found: true
      },
      IPList: [],
      loaders: false,
      loadersRecoverAll: false,
      errors: this.initErrors(),
      tableLangsTexts: this.tableLangs(),
    columns: [
      {
        label: this.$i18n.t("quarantine.Path_to_quarantined_file"),
        field: "path",
        filterable: true
      },
      {
        label: this.$i18n.t("quarantine.Matched_rule"),
        field: "ruleMatch",
        filterable: true
      },
      {
          label: this.$i18n.t("quarantine.RecoverTheseFiles"),
          field: "",
          filterable: true,
          sortable: false
      },
      {
          label: this.$i18n.t("quarantine.ExcludeTheseFiles"),
          field: "",
          filterable: true,
          sortable: false
      }
    ],
    columnsFound: [
      {
        label: this.$i18n.t("quarantine.Path_to_suspicious_file"),
        field: "path",
        filterable: true
      },
      {
        label: this.$i18n.t("quarantine.Matched_rule"),
        field: "ruleMatch",
        filterable: true
      }
    ],
    quarantine: [],
    found: []
    };
  },
  methods: {
    initErrors() {
      return {
      unBanIP: {
        hasError: false,
        message: ""
      }
      };
    },
    SwitchView() {
      this.view.Found = !this.view.Found;
      this.$forceUpdate();
    },
    getQuarantined() {
      var context = this;

      context.view.isLoaded = false;
      nethserver.exec(
        ["nethserver-clamscan/read"],
        {
          action: "quarantine"
        },
        null,
        function(success) {
          try {
            success = JSON.parse(success);
          } catch (e) {
            console.error(e);
          }
          context.quarantine = success.Quarantine;
          context.found = success.Found;
          
        context.view.isLoaded = true;
        },
        function(error) {
          console.error(error);
        },
        true //sudo
      );
    },
    restore(type) {
      var context = this;
      var settingsObj = {
        action: "restore",
         restore: type
      };
      console.log(type);
      context.loaders = true;
     context.errors = context.initErrors();
      nethserver.exec(
        ["nethserver-clamscan/validate"],
        settingsObj,
        null,
        function(success) {
          context.loaders = false;
    
          // notification
          nethserver.notifications.success = context.$i18n.t(
            "quarantine.File_restored"
          );
          nethserver.notifications.error = context.$i18n.t(
            "quarantine.File_restoration_Error"
          );
    
          // update values
          nethserver.exec(
            ["nethserver-clamscan/update"],
            settingsObj,
            function(stream) {
              console.info("Clamscan", stream);
            },
            function(success) {
              context.getQuarantined();
            },
            function(error, data) {
              console.error(error, data);
            },
            true //sudo
          );
        },
        function(error, data) {
          var errorData = {};
          context.loaders = false;
          context.errors = context.initErrors();
    
          try {
            errorData = JSON.parse(data);
            for (var e in errorData.attributes) {
              var attr = errorData.attributes[e];
              context.errors[attr.parameter].hasError = true;
              context.errors[attr.parameter].message = attr.error;
            }
          } catch (e) {
            console.error(e);
          }
      },
        true //sudo
    );
  },
  exclude(type) {
      var context = this;
      var settingsObj = {
        action: "exclude",
         restore: type
      };
      console.log(type);
      context.loaders = true;
     context.errors = context.initErrors();
      nethserver.exec(
        ["nethserver-clamscan/validate"],
        settingsObj,
        null,
        function(success) {
          context.loaders = false;
    
          // notification
          nethserver.notifications.success = context.$i18n.t(
            "quarantine.File_restored_and_excluded"
          );
          nethserver.notifications.error = context.$i18n.t(
            "quarantine.File_restoration_and_exclusion_Error"
          );
    
          // update values
          nethserver.exec(
            ["nethserver-clamscan/update"],
            settingsObj,
            function(stream) {
              console.info("Clamscan", stream);
            },
            function(success) {
              context.getQuarantined();
            },
            function(error, data) {
              console.error(error, data);
            },
            true //sudo
          );
        },
        function(error, data) {
          var errorData = {};
          context.loaders = false;
          context.errors = context.initErrors();
    
          try {
            errorData = JSON.parse(data);
            for (var e in errorData.attributes) {
              var attr = errorData.attributes[e];
              context.errors[attr.parameter].hasError = true;
              context.errors[attr.parameter].message = attr.error;
            }
          } catch (e) {
            console.error(e);
          }
      },
        true //sudo
    );
  },
    RecoverAll(type) {
    var context = this;
    var settingsObj = {
      action: "RestoreAll"
    };
    context.loadersRecoverAll = true;
    context.errors = context.initErrors();
    nethserver.exec(
      ["nethserver-clamscan/validate"],
      settingsObj,
      null,
      function(success) {
        context.loadersRecoverAll = false;
    
        // notification
        nethserver.notifications.success = context.$i18n.t(
          "quarantine.RecoverAll__ok"
        );
        nethserver.notifications.error = context.$i18n.t(
          "clamscan.RecoverAll_error"
        );
        // update values
        nethserver.exec(
          ["nethserver-clamscan/update"],
          settingsObj,
          function(stream) {
            console.info("clamscan", stream);
          },
          function(success) {
            context.getQuarantined();
          },
          function(error, data) {
            console.error(error, data);
          },
          true //sudo
        );
      },
      function(error, data) {
        var errorData = {};
        context.loaders = false;
        context.errors = context.initErrors();
        try {
          errorData = JSON.parse(data);
          for (var e in errorData.attributes) {
            var attr = errorData.attributes[e];
            context.errors[attr.parameter].hasError = true;
            context.errors[attr.parameter].message = attr.error;
            context.errors[attr.parameter].value = attr.value;
          }
        } catch (e) {
          console.error(e);
        }
    },
      true // sudo
  );
  },
  }
};
</script>

<style>
.divider {
    border-top: 1px solid #d1d1d1;
}
.right {
    float: right;
}
.span-right-margin-recoverAll {
    margin-right: 30px;
}
.mg-righ-found {
      margin-right: 10px;
}
</style>
