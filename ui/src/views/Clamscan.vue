<template>
  <div> <!-- Do not remove :( -->
  <h2>{{$t('clamscan.title')}}</h2>
  <h3>{{$t('clamscan.Scan_files_and_directories_for_viruses')}}</h3>
  <div v-if="!view.isLoaded" class="spinner spinner-lg"></div>
  <div v-if="view.isLoaded">
  <form class="form-horizontal" v-on:submit.prevent="saveSettings('status')">
    <div :class="['form-group', errors.status.hasError ? 'has-error' : '']">
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('clamscan.status')}}</label>
          <div class="col-sm-5">
            <toggle-button
              class="min-toggle"
              :width="40"
              :height="20"
              :color="{checked: '#0088ce', unchecked: '#bbbbbb'}"
              :value="configuration.status"
              :sync="true"
              @change="toggleStatus()"
            />
            <span
              v-if="errors.status.hasError"
              class="help-block"
            >{{errors.status.message}}</span>
          </div>
    </div>
    <div
      v-if="configuration.status"
      :class="['form-group', errors.FilesystemScan.hasError ? 'has-error' : '']"
    >
      <label
          class="col-sm-2 control-label"
          for="textInput-modal-markup"
      >{{$t('clamscan.FilesystemScan')}}
      </label>
      <div class="col-sm-5">
        <input type="radio" id="daily" value="daily"
          v-model="configuration.FilesystemScan" class="form-control" >
        <label for="daily">{{$t('clamscan.FilesystemScan_daily')}}</label>
        <br />
        <input type="radio" id="weekly" value="weekly"
          v-model="configuration.FilesystemScan" class="form-control" >
        <label for="weekly">{{$t('clamscan.FilesystemScan_weekly')}}</label>
        <br />
        <input type="radio" id="now" value="now"
          v-model="configuration.FilesystemScan" class="form-control" >
        <label for="daily">{{$t('clamscan.FilesystemScan_now')}}</label>
        <br />
        <span
          v-if="errors.FilesystemScan.hasError"
          class="help-block"
        >{{errors.FilesystemScan.message}}</span>
      </div>
    </div>
    <div v-if="configuration.status && configuration.FilesystemScan == 'daily'" 
            :class="['form-group', errors.JobHour.hasError ? 'has-error' : '']">
        <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
            >{{$t('clamscan.JobHour')}}
        </label>
        <div class="col-sm-5">
            <select v-model="configuration.JobHour" class="form-control">
                <option selected value="0h">{{ $t('clamscan.0h')}}</option>
                <option value="1h">{{ $t('clamscan.1h')}}</option>
                <option value="2h">{{ $t('clamscan.2h')}}</option>
                <option value="3h">{{ $t('clamscan.3h')}}</option>
                <option value="4h">{{ $t('clamscan.4h')}}</option>
                <option value="5h">{{ $t('clamscan.5h')}}</option>
                <option value="6h">{{ $t('clamscan.6h')}}</option>
                <option value="7h">{{ $t('clamscan.7h')}}</option>
                <option value="8h">{{ $t('clamscan.8h')}}</option>
                <option value="9h">{{ $t('clamscan.9h')}}</option>
                <option value="10h">{{ $t('clamscan.10h')}}</option>
                <option value="11h">{{ $t('clamscan.11h')}}</option>
                <option value="12h">{{ $t('clamscan.12h')}}</option>
                <option value="13h">{{ $t('clamscan.13h')}}</option>
                <option value="14h">{{ $t('clamscan.14h')}}</option>
                <option value="15h">{{ $t('clamscan.15h')}}</option>
                <option value="16h">{{ $t('clamscan.16h')}}</option>
                <option value="17h">{{ $t('clamscan.17h')}}</option>
                <option value="18h">{{ $t('clamscan.18h')}}</option>
                <option value="19h">{{ $t('clamscan.19h')}}</option>
                <option value="20h">{{ $t('clamscan.20h')}}</option>
                <option value="21h">{{ $t('clamscan.21h')}}</option>
                <option value="22h">{{ $t('clamscan.22h')}}</option>
                <option value="23h">{{ $t('clamscan.23h')}}</option>
            </select>
            <span
              v-if="errors.JobHour.hasError"
              class="help-block"
            >{{errors.JobHour.message}}</span>
        </div>
    </div>
    <div v-if="configuration.status && configuration.FilesystemScan == 'weekly'" 
            :class="['form-group', errors.JobDay.hasError ? 'has-error' : '']">
        <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
            >{{$t('clamscan.JobDay')}}
        </label>
        <div class="col-sm-5">
            <select v-model="configuration.JobDay" class="form-control">
                <option selected value="1d">{{ $t('clamscan.1d')}}</option>
                <option value="2d">{{ $t('clamscan.2d')}}</option>
                <option value="3d">{{ $t('clamscan.3d')}}</option>
                <option value="4d">{{ $t('clamscan.4d')}}</option>
                <option value="5d">{{ $t('clamscan.5d')}}</option>
                <option value="6d">{{ $t('clamscan.6d')}}</option>
                <option value="7d">{{ $t('clamscan.7d')}}</option>
            </select>
            <span
              v-if="errors.JobDay.hasError"
              class="help-block"
            >{{errors.JobDay.message}}</span>
        </div>
    </div>
    <div v-if="configuration.status && configuration.FilesystemScan == 'weekly'" 
            :class="['form-group', errors.JobHour.hasError ? 'has-error' : '']">
        <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
            >{{$t('clamscan.JobHour')}}
        </label>
        <div class="col-sm-5">
            <select v-model="configuration.JobHour" class="form-control">
                <option selected value="0h">{{ $t('clamscan.0h')}}</option>
                <option value="1h">{{ $t('clamscan.1h')}}</option>
                <option value="2h">{{ $t('clamscan.2h')}}</option>
                <option value="3h">{{ $t('clamscan.3h')}}</option>
                <option value="4h">{{ $t('clamscan.4h')}}</option>
                <option value="5h">{{ $t('clamscan.5h')}}</option>
                <option value="6h">{{ $t('clamscan.6h')}}</option>
                <option value="7h">{{ $t('clamscan.7h')}}</option>
                <option value="8h">{{ $t('clamscan.8h')}}</option>
                <option value="9h">{{ $t('clamscan.9h')}}</option>
                <option value="10h">{{ $t('clamscan.10h')}}</option>
                <option value="11h">{{ $t('clamscan.11h')}}</option>
                <option value="12h">{{ $t('clamscan.12h')}}</option>
                <option value="13h">{{ $t('clamscan.13h')}}</option>
                <option value="14h">{{ $t('clamscan.14h')}}</option>
                <option value="15h">{{ $t('clamscan.15h')}}</option>
                <option value="16h">{{ $t('clamscan.16h')}}</option>
                <option value="17h">{{ $t('clamscan.17h')}}</option>
                <option value="18h">{{ $t('clamscan.18h')}}</option>
                <option value="19h">{{ $t('clamscan.19h')}}</option>
                <option value="20h">{{ $t('clamscan.20h')}}</option>
                <option value="21h">{{ $t('clamscan.21h')}}</option>
                <option value="22h">{{ $t('clamscan.22h')}}</option>
                <option value="23h">{{ $t('clamscan.23h')}}</option>
            </select>
            <span
              v-if="errors.JobHour.hasError"
              class="help-block"
            >{{errors.JobHour.message}}</span>
        </div>
    </div>
    <div  v-if="configuration.status && configuration.FilesystemScan == 'now'"
          :class="['form-group', errors.FilesystemScanFilesystems.hasError ? 'has-error' : '']"
    >
      <label class="col-sm-2 control-label" for="textInput-modal-markup">
            {{$t('clamscan.Scan_filesystem_now')}}
      </label>
      <form v-on:submit.prevent="scanFileSystem(configuration.FilesystemScanFilesystems)">
        <div class="col-sm-3">
          <input 
            placeholder="/" 
            v-model="configuration.FilesystemScanFilesystems" class="form-control" 
          />
          <span
            v-if="errors.FilesystemScanFilesystems.hasError"
            class="help-block">
            {{$t('validation.validation_failed')}}:
            {{$t('validation.'+errors.FilesystemScanFilesystems.message)}}
        </div>
        <div class="col-sm-5">
            <span v-if="loadersScan" class="spinner spinner-sm form-spinner-loader adjust-top-loader"></span>
          <button class="btn btn-primary" type="submit">{{$t('clamscan.start_scan_now')}}</button>
        </div>
      </form>
    </div>
    <div v-if="configuration.status">
      <div :class="['form-group', errors.MaxScanFile.hasError ? 'has-error' : '']">
        <label class="col-sm-2 control-label" for="textInput-modal-markup">
              {{$t('clamscan.MaxScanFile')}}
        </label>
          <div class="col-sm-5">
            <input 
              type="number"
              v-model="configuration.MaxScanFile" class="form-control" 
            />
            <span
              v-if="errors.MaxScanFile.hasError"
              class="help-block"
            >{{errors.MaxScanFile.message}}</span>
          </div>
      </div>
      <div :class="['form-group', errors.FilesystemScanExclude.hasError ? 'has-error' : '']">
        <label
          class="col-sm-2 control-label"
          for="textInput-modal-markup"
        >{{$t('clamscan.FilesystemScanExclude')}}</label>
        <div class="col-sm-5">
          <textarea rows="5" v-model="configuration.FilesystemScanExclude" class="form-control"></textarea>
          <span v-if="errors.FilesystemScanExclude.hasError" class="help-block">
            {{$t('validation.validation_failed')}}:
            {{$t('validation.'+errors.FilesystemScanExclude.message)}}: {{errors.FilesystemScanExclude.value}}
          </span>
        </div>
      </div>
    </div>
    <div v-if="configuration.status">
      <label>{{$t('clamscan.Before_to_activate_quarantine_you_should_test_your_settings_first')}}</label>
    </div>
    <div v-if="configuration.status" :class="['form-group', errors.Quarantine.hasError ? 'has-error' : '']">
          <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
          >{{$t('clamscan.Quarantine')}}</label>
          <div class="col-sm-5">
            <toggle-button
              class="min-toggle"
              :width="40"
              :height="20"
              :color="{checked: '#0088ce', unchecked: '#bbbbbb'}"
              :value="configuration.Quarantine"
              :sync="true"
              @change="toggleQuarantine()"
            />
            <span
              v-if="errors.Quarantine.hasError"
              class="help-block"
            >{{errors.Quarantine.message}}</span>
          </div>
    </div>
    <div v-if="configuration.status" class="form-group">
        <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
        >{{$t('clamscan.Virus_Database')}}
        <doc-info
          :placement="'right'"
          :title="$t('clamscan.Virus_Database')"
          :chapter="'OfficialSignatures'"
          :inline="true"
        ></doc-info>
        </label>
        <div class="col-sm-3 dialog">
          {{$t('clamscan.Database_'+configuration.alarm)}}
        </div>
        <div v-if="configuration.OfficialSignatures === 'disabled' "class="col-sm-5 dialog">
          {{$t('clamscan.OfficialSignatures_disabled_in_antivirus_module')}}
        </div>
    </div>
    <div v-if="configuration.status" class="form-group" >
        <label
            class="col-sm-2 control-label"
            for="textInput-modal-markup"
        >{{$t('clamscan.Last_Update_Database')}}
        </label>
        <form v-on:submit.prevent="FreshClamUpdate('status')">
          <div class="col-sm-3 dialog">
            {{configuration.timestamp  | dateFormat}}
          </div>
          <div class="col-sm-5">
            <span v-if="loadersFreshClam" class="spinner spinner-sm form-spinner-loader adjust-top-loader"></span>
            <button  class="btn btn-default" type="submit">{{$t('clamscan.FreshClamUpdate')}}</button>
          </div>
        </form>
    </div>
    <div v-if="configuration.status" class="form-group">
        <label
          class="col-sm-2 control-label"
          for="textInput-modal-markup"
          >{{$t('clamscan.Virus_Scanning')}}
        </label>
        <div class="col-sm-3 dialog"
          >{{$t('clamscan.Virus_scanning_'+configuration.clamscan)}}
        </div>
    </div>
    
    <div  class="form-group">
      <label class="col-sm-2 control-label" for="textInput-modal-markup">
      <span v-if="loaders" class="spinner spinner-sm form-spinner-loader adjust-top-loader"></span>
      </label>
      <div class="col-sm-5">
        <button :disabled="configuration.FilesystemScan == 'now'" class="btn btn-primary" type="submit">{{$t('save')}}</button>
      </div>
    </div>
</form>
    </div>
</template>

<script>
export default {
  name: "Clamscan",
  components: {
  },
  mounted() {
    this.getSettings();
  },
  beforeRouteLeave(to, from, next) {
    $(".modal").modal("hide");
    next();
  },
  data() {
  return {
    view: {
      isLoaded: false
    },
    advanced: false,
    configuration: {
      status: "enabled",
      FilesystemScan: "daily",
      JobHour: "0h",
      JobDay: "1d",
      FilesystemScanFilesystems: "/",
      MaxScanFile: 45,
      FilesystemScanExclude:"",
      Quarantine: "disabled"
    },
    loaders: false,
    loadersScan: false,
    loadersFreshClam: false,
    errors: this.initErrors()
  };
},
methods: {
  initErrors() {
    return {
      status: {
        hasError: false,
        message: ""
      },
      FilesystemScan: {
        hasError: false,
        message: ""
      },
      JobHour: {
        hasError: false,
        message: ""
      },
      JobDay: {
        hasError: false,
        message: ""
      },
      FilesystemScanFilesystems: {
        hasError: false,
        message: ""
      },
      MaxScanFile:  {
        hasError: false,
        message: ""
      },
      FilesystemScanExclude:{
        hasError: false,
        message: "",
        value:""
      },
      Quarantine:{
        hasError: false,
        message: ""
      }
    };
  },
  getSettings() {
    var context = this;
    context.view.isLoaded = false;
    context.advanced = false;
    
    nethserver.exec(
      ["nethserver-clamscan/read"],
      {
        action: "configuration"
      },
      null,
      function(success) {
        try {
          success = JSON.parse(success);
        } catch (e) {
          console.error(e);
        }
        context.configuration = success.configuration;
        context.configuration.status = success.configuration.status == "enabled";
        context.configuration.Quarantine = success.configuration.Quarantine == "enabled";

        context.view.isLoaded = true;
      },
      function(error) {
        console.error(error);
          context.view.isLoaded = true;
      }
    );
  },
  toggleStatus() {
    this.configuration.status = !this.configuration.status;
    this.$forceUpdate();
  },
  toggleQuarantine() {
    this.configuration.Quarantine = !this.configuration.Quarantine;
    this.$forceUpdate();
  },
  saveSettings(type) {
    var context = this;
    var settingsObj = {
      action: "clamscan",
      status: context.configuration.status
        ? "enabled"
        : "disabled",
      Quarantine: context.configuration.Quarantine
        ? "enabled"
        : "disabled",
      FilesystemScan: context.configuration.FilesystemScan,
      JobHour: context.configuration.JobHour,
      JobDay: context.configuration.JobDay,
      MaxScanFile: context.configuration.MaxScanFile,
      FilesystemScanExclude: context.configuration.FilesystemScanExclude
    //  Users: context.configuration.Users.split("\n").join(","),
    };
    context.loaders = true;
    context.errors = context.initErrors();
    nethserver.exec(
      ["nethserver-clamscan/validate"],
      settingsObj,
      null,
      function(success) {
        context.loaders = false;
        context.loadersScan = false;
        // notification
        nethserver.notifications.success = context.$i18n.t(
          "clamscan.settings_updated_ok"
        );
        nethserver.notifications.error = context.$i18n.t(
          "clamscan.settings_updated_error"
        );
        // update values
        nethserver.exec(
          ["nethserver-clamscan/update"],
          settingsObj,
          function(stream) {
            console.info("clamscan", stream);
          },
          function(success) {
            context.getSettings();
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
        context.loadersScan = false;
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
  scanFileSystem(type) {
    var context = this;
    var settingsObj = {
      action: "scanFileSystemNow",
      status: context.configuration.status
        ? "enabled"
        : "disabled",
      Quarantine: context.configuration.Quarantine
        ? "enabled"
        : "disabled",
      FilesystemScanFilesystems: context.configuration.FilesystemScanFilesystems,
      FilesystemScan: context.configuration.FilesystemScan,
      MaxScanFile: context.configuration.MaxScanFile,
      FilesystemScanExclude: context.configuration.FilesystemScanExclude
    };
    context.loadersScan = true;
    context.errors = context.initErrors();
    nethserver.exec(
      ["nethserver-clamscan/validate"],
      settingsObj,
      null,
      function(success) {
        context.loadersScan = false;
    
        // notification
        nethserver.notifications.success = context.$i18n.t(
          "clamscan.Scan_Now__ok"
        );
        nethserver.notifications.error = context.$i18n.t(
          "clamscan.Scan_Now_error"
        );
        // update values
        nethserver.exec(
          ["nethserver-clamscan/update"],
          settingsObj,
          function(stream) {
            console.info("clamscan", stream);
          },
          function(success) {
            context.getSettings();
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
        context.loadersScan = false;
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
  FreshClamUpdate(type) {
    var context = this;
    var settingsObj = {
      action: "FreshClamUpdate"
    };
    context.loadersFreshClam = true;
    context.errors = context.initErrors();
    nethserver.exec(
      ["nethserver-clamscan/validate"],
      settingsObj,
      null,
      function(success) {
        context.loadersFreshClam = false;
    
        // notification
        nethserver.notifications.success = context.$i18n.t(
          "clamscan.FreshClamUpdate__ok"
        );
        nethserver.notifications.error = context.$i18n.t(
          "clamscan.FreshClamUpdate_error"
        );
        // update values
        nethserver.exec(
          ["nethserver-clamscan/update"],
          settingsObj,
          function(stream) {
            console.info("clamscan", stream);
          },
          function(success) {
            context.getSettings();
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
        context.loadersFreshClam = false;
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
  toggleAdvancedMode() {
    this.advanced = !this.advanced;
    this.$forceUpdate();
  }
}
};
</script>

<style>
input[type=radio].form-control {
    width: 20px !important;
    height: 20px !important;
    display: inline-block;
    vertical-align: -25%;
    margin-right: 1em;
}
.dialog {
  margin-top:3px
}
</style>
