<template>
   <div> <!-- Do not remove :( -->
  <h2>{{$t('files.title')}}</h2>
  <h3>{{$t('files.Scan_inside_these_types_of_files')}}</h3>
  <div v-if="!view.isLoaded" class="spinner spinner-lg"></div>
  <div v-if="view.isLoaded">
  <form class="form-horizontal" v-on:submit.prevent="saveSettings('status')">
    <div
      :class="['form-group', errors.ScanArchive.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('files.ScanArchive')}}
      <doc-info
        :placement="'right'"
        :title="$t('files.ScanArchive')"
        :chapter="'ScanArchive'"
        :inline="true"
      ></doc-info>
      </label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="files.ScanArchive"
          class="form-control"
        >
        <span
          v-if="errors.ScanArchive.hasError"
          class="help-block"
        >{{errors.ScanArchive.message}}</span>
      </div>
    </div>
    <div
      :class="['form-group', errors.ScanElf.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('files.ScanElf')}}
      <doc-info
        :placement="'right'"
        :title="$t('files.ScanElf')"
        :chapter="'ScanElf'"
        :inline="true"
      ></doc-info>
      </label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="files.ScanElf"
          class="form-control"
        >
        <span
          v-if="errors.ScanElf.hasError"
          class="help-block"
        >{{errors.ScanElf.message}}</span>
      </div>
    </div>
    <div
      :class="['form-group', errors.ScanHTML.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('files.ScanHTML')}}
      <doc-info
        :placement="'right'"
        :title="$t('files.ScanHTML')"
        :chapter="'ScanHTML'"
        :inline="true"
      ></doc-info>
      </label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="files.ScanHTML"
          class="form-control"
        >
        <span
          v-if="errors.ScanHTML.hasError"
          class="help-block"
        >{{errors.ScanHTML.message}}</span>
      </div>
    </div>
    <div
      :class="['form-group', errors.ScanHwp.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('files.ScanHwp')}}
      <doc-info
        :placement="'right'"
        :title="$t('files.ScanHwp')"
        :chapter="'ScanHwp'"
        :inline="true"
      ></doc-info>
      </label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="files.ScanHwp"
          class="form-control"
        >
        <span
          v-if="errors.ScanHwp.hasError"
          class="help-block"
        >{{errors.ScanHwp.message}}</span>
      </div>
    </div>
    <div
      :class="['form-group', errors.ScanMail.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('files.ScanMail')}}
      <doc-info
        :placement="'right'"
        :title="$t('files.ScanMail')"
        :chapter="'ScanMail'"
        :inline="true"
      ></doc-info>
      </label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="files.ScanMail"
          class="form-control"
        >
        <span
          v-if="errors.ScanMail.hasError"
          class="help-block"
        >{{errors.ScanMail.message}}</span>
      </div>
    </div>
    <div
      :class="['form-group', errors.ScanOle2.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('files.ScanOle2')}}
      <doc-info
        :placement="'right'"
        :title="$t('files.ScanOle2')"
        :chapter="'ScanOle2'"
        :inline="true"
      ></doc-info>
      </label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="files.ScanOle2"
          class="form-control"
        >
        <span
          v-if="errors.ScanOle2.hasError"
          class="help-block"
        >{{errors.ScanOle2.message}}</span>
      </div>
    </div>
    <div
      :class="['form-group', errors.ScanPdf.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('files.ScanPdf')}}
      <doc-info
        :placement="'right'"
        :title="$t('files.ScanPdf')"
        :chapter="'ScanPdf'"
        :inline="true"
      ></doc-info>
      </label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="files.ScanPdf"
          class="form-control"
        >
        <span
          v-if="errors.ScanPdf.hasError"
          class="help-block"
        >{{errors.ScanPdf.message}}</span>
      </div>
    </div>
    <div
      :class="['form-group', errors.ScanPe.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('files.ScanPe')}}
      <doc-info
        :placement="'right'"
        :title="$t('files.ScanPe')"
        :chapter="'ScanPe'"
        :inline="true"
      ></doc-info>
      </label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="files.ScanPe"
          class="form-control"
        >
        <span
          v-if="errors.ScanPe.hasError"
          class="help-block"
        >{{errors.ScanPe.message}}</span>
      </div>
    </div>
    <div
      :class="['form-group', errors.ScanSwf.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('files.ScanSwf')}}
      <doc-info
        :placement="'right'"
        :title="$t('files.ScanSwf')"
        :chapter="'ScanSwf'"
        :inline="true"
      ></doc-info>
      </label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="files.ScanSwf"
          class="form-control"
        >
        <span
          v-if="errors.ScanSwf.hasError"
          class="help-block"
        >{{errors.ScanSwf.message}}</span>
      </div>
    </div>
    <div
      :class="['form-group', errors.ScanXML.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('files.ScanXML')}}
      <doc-info
        :placement="'right'"
        :title="$t('files.ScanXML')"
        :chapter="'ScanXML'"
        :inline="true"
      ></doc-info>
      </label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="files.ScanXML"
          class="form-control"
        >
        <span
          v-if="errors.ScanXML.hasError"
          class="help-block"
        >{{errors.ScanXML.message}}</span>
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
  name: "Detections",
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
    files: {
      ScanArchive: "disabled",
      ScanElf: "disabled",
      ScanHTML: "disabled",
      ScanHwp: "disabled",
      ScanMail: "disabled",
      ScanOle2: "disabled",
      ScanPdf: "disabled",
      ScanPe: "disabled",
      ScanSwf: "disabled",
      ScanXML: "disabled"
    },
    loaders: false,
    errors: this.initErrors()
  };
},
methods: {
  initErrors() {
    return {
      ScanArchive: {
        hasError: false,
        message: ""
      },
      ScanElf: {
        hasError: false,
        message: ""
      },
      ScanHTML: {
        hasError: false,
        message: ""
      },
      ScanHwp: {
        hasError: false,
        message: ""
      },
      ScanMail: {
        hasError: false,
        message: ""
      },
      ScanOle2: {
        hasError: false,
        message: ""
      },
      ScanPdf: {
        hasError: false,
        message: ""
      },
      ScanPe: {
        hasError: false,
        message: ""
      },
      ScanSwf: {
        hasError: false,
        message: ""
      },
      ScanXML: {
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
        action: "files"
      },
      null,
      function(success) {
        try {
          success = JSON.parse(success);
        } catch (e) {
          console.error(e);
        }
        context.files = success.configuration;
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
      action: "files",
      ScanArchive: context.files.ScanArchive,
      ScanElf: context.files.ScanElf,
      ScanHTML: context.files.ScanHTML,
      ScanHwp: context.files.ScanHwp,
      ScanMail: context.files.ScanMail,
      ScanOle2: context.files.ScanOle2,
      ScanPdf: context.files.ScanPdf,
      ScanPe: context.files.ScanPe,
      ScanSwf: context.files.ScanSwf,
      ScanXML: context.files.ScanXML
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

</style>
