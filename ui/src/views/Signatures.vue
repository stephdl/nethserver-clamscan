<template>
   <div> <!-- Do not remove :( -->
  <h2>{{$t('signatures.title')}}</h2>
  <h3>{{$t('signatures.Virus_Database_might_have_false_positive')}}</h3>
  <div v-if="!view.isLoaded" class="spinner spinner-lg"></div>
  <div v-if="view.isLoaded">
  <form class="form-horizontal" v-on:submit.prevent="saveSettings('status')">
    <div
      :class="['form-group', errors.Bytecode.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('signatures.Bytecode')}}
      <doc-info
        :placement="'right'"
        :title="$t('signatures.Bytecode')"
        :chapter="'Bytecode'"
        :inline="true"
      ></doc-info>
      </label>
      <div class="col-sm-5">
          <input
            type="checkbox"
            true-value="enabled"
            false-value="disabled"
            v-model="signatures.Bytecode"
            class="form-control"
            @change="toggleBytecode()"
          >
        <span
          v-if="errors.Bytecode.hasError"
          class="help-block"
        >{{errors.Bytecode.message}}</span>
      </div>
    </div>
    <div v-if="view.toggleBytecode"
      :class="['form-group', errors.BytecodeUnsigned.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('signatures.BytecodeUnsigned')}}
      <doc-info
        :placement="'right'"
        :title="$t('signatures.BytecodeUnsigned')"
        :chapter="'BytecodeUnsigned'"
        :inline="true"
      ></doc-info>
      </label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="signatures.BytecodeUnsigned"
          class="form-control"
        >
        <span
          v-if="errors.BytecodeUnsigned.hasError"
          class="help-block"
        >{{errors.BytecodeUnsigned.message}}</span>
      </div>
    </div>
    <div
      :class="['form-group', errors.FilesystemScanUnofficialSigs.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('signatures.FilesystemScanUnofficialSigs')}}
      <doc-info
        :placement="'right'"
        :title="$t('signatures.FilesystemScanUnofficialSigs')"
        :chapter="'FilesystemScanUnofficialSigs'"
        :inline="true"
      ></doc-info>
      </label>
      <div class="col-sm-1">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="signatures.FilesystemScanUnofficialSigs"
          class="form-control"
        >
        <span
          v-if="errors.FilesystemScanUnofficialSigs.hasError"
          class="help-block"
        >{{errors.FilesystemScanUnofficialSigs.message}}</span>
      </div>
      <div class="col-sm-2 dialog">
        {{$t('signatures.UnofficialSigs_are_set_to_'+signatures.UnofficialSignaturesRating)}}
      </div>
    </div>
    <div
      :class="['form-group', errors.PhishingSigs.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('signatures.PhishingSigs')}}
      <doc-info
        :placement="'right'"
        :title="$t('signatures.PhishingSigs')"
        :chapter="'PhishingSigs'"
        :inline="true"
      ></doc-info>
      </label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="signatures.PhishingSigs"
          class="form-control"
        >
        <span
          v-if="errors.PhishingSigs.hasError"
          class="help-block"
        >{{errors.PhishingSigs.message}}</span>
      </div>
    </div>
    <div
      :class="['form-group', errors.PhishingScanUrl.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('signatures.PhishingScanUrl')}}
      <doc-info
        :placement="'right'"
        :title="$t('signatures.PhishingScanUrl')"
        :chapter="'PhishingScanUrl'"
        :inline="true"
      ></doc-info>
      </label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="signatures.PhishingScanUrl"
          class="form-control"
        >
        <span
          v-if="errors.PhishingScanUrl.hasError"
          class="help-block"
        >{{errors.PhishingScanUrl.message}}</span>
      </div>
    </div>
    <div  class="form-group">
      <label class="col-sm-2 control-label" for="textInput-modal-markup">
      <span v-if="loaders" class="spinner spinner-sm form-spinner-loader adjust-top-loader"></span>
      </label>
      <div class="col-sm-5">
        <button class="btn btn-primary" type="submit">{{$t('save')}}</button>
      </div>
    </div>
  </form>
  </div>
</template>

<script>
export default {
  name: "Signatures",
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
      isLoaded: false,
      toggleBytecode: false
    },
    advanced: false,
    signatures: {
      Bytecode: "disabled",
      BytecodeUnsigned: "disabled",
      FilesystemScanUnofficialSigs: "disabled",
      PhishingSigs: "disabled",
      PhishingScanUrl: "disabled"
    },
    loaders: false,
    errors: this.initErrors()
  };
},
methods: {
  initErrors() {
    return {
      Bytecode: {
        hasError: false,
        message: ""
      },
      BytecodeUnsigned: {
        hasError: false,
        message: ""
      },
      FilesystemScanUnofficialSigs: {
        hasError: false,
        message: ""
      },
      PhishingSigs: {
        hasError: false,
        message: ""
      },
      PhishingScanUrl: {
        hasError: false,
        message: ""
      }
    };
  },
    toggleBytecode() {
    this.view.toggleBytecode = !this.view.toggleBytecode;
    this.$forceUpdate();
  },
  getSettings() {
    var context = this;
    context.view.isLoaded = false;
    context.advanced = false;
    
    nethserver.exec(
      ["nethserver-clamscan/read"],
      {
        action: "signatures"
      },
      null,
      function(success) {
        try {
          success = JSON.parse(success);
        } catch (e) {
          console.error(e);
        }
        context.signatures = success.configuration;
        if (context.signatures.Bytecode === 'enabled') {
            context.view.toggleBytecode = true;
        }
        context.view.isLoaded = true;
      },
      function(error) {
        console.error(error);
          context.view.isLoaded = true;
      }
    );
  },
  saveSettings(type) {
    var context = this;
    var settingsObj = {
      action: "signatures",
      Bytecode: context.signatures.Bytecode,
      BytecodeUnsigned: context.signatures.BytecodeUnsigned,
      FilesystemScanUnofficialSigs: context.signatures.FilesystemScanUnofficialSigs,
      PhishingSigs: context.signatures.PhishingSigs,
      PhishingScanUrl: context.signatures.PhishingScanUrl
    };
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
          "signatures.settings_updated_ok"
        );
        nethserver.notifications.error = context.$i18n.t(
          "signatures.settings_updated_error"
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
 }
}
};
</script>

<style>
.dialog {
  margin-top:3px
}
</style>
