<template>
  <div>
  <h2>{{$t('detections.title')}}</h2>
  <h3>{{$t('detections.Scanning_Options_might_give_false_positives')}}</h3>
  <div v-if="!view.isLoaded" class="spinner spinner-lg"></div>
  <div v-if="view.isLoaded">
  <form class="form-horizontal" v-on:submit.prevent="saveSettings('status')">
    <div
      :class="['form-group', errors.AlgoDetection.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('detections.AlgoDetection')}}</label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="detections.AlgoDetection"
          class="form-control"
        >
        <span
          v-if="errors.AlgoDetection.hasError"
          class="help-block"
        >{{errors.AlgoDetection.message}}</span>
      </div>
    </div>
    <div
      :class="['form-group', errors.BlockEncrypted.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('detections.BlockEncrypted')}}</label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="detections.BlockEncrypted"
          class="form-control"
        >
        <span
          v-if="errors.BlockEncrypted.hasError"
          class="help-block"
        >{{errors.BlockEncrypted.message}}</span>
      </div>
    </div>
    <div
      :class="['form-group', errors.BlockMacros.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('detections.BlockMacros')}}</label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="detections.BlockMacros"
          class="form-control"
        >
        <span
          v-if="errors.BlockMacros.hasError"
          class="help-block"
        >{{errors.BlockMacros.message}}</span>
      </div>
    </div>
    <div
      :class="['form-group', errors.DetectStructured.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('detections.DetectStructured')}}</label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="detections.DetectStructured"
          class="form-control"
        >
        <span
          v-if="errors.DetectStructured.hasError"
          class="help-block"
        >{{errors.DetectStructured.message}}</span>
      </div>
    </div>
    <div
      :class="['form-group', errors.DetectBroken.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('detections.DetectBroken')}}</label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="detections.DetectBroken"
          class="form-control"
        >
        <span
          v-if="errors.DetectBroken.hasError"
          class="help-block"
        >{{errors.DetectBroken.message}}</span>
      </div>
    </div>
    <div
      :class="['form-group', errors.PartInstersection.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('detections.PartInstersection')}}</label>
      <div class="col-sm-5">
        <input
          type="checkbox"
          true-value="enabled"
          false-value="disabled"
          v-model="detections.PartInstersection"
          class="form-control"
        >
        <span
          v-if="errors.PartInstersection.hasError"
          class="help-block"
        >{{errors.PartInstersection.message}}</span>
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
    detections: {
      AlgoDetection: "disabled",
      BlockEncrypted: "disabled",
      BlockMacros: "disabled",
      DetectStructured: "disabled",
      DetectBroken: "disabled",
      PartInstersection: "disabled"
    },
    loaders: false,
    errors: this.initErrors()
  };
},
methods: {
  initErrors() {
    return {
      AlgoDetection: {
        hasError: false,
        message: ""
      },
      BlockEncrypted: {
        hasError: false,
        message: ""
      },
      BlockMacros: {
        hasError: false,
        message: ""
      },
      DetectStructured: {
        hasError: false,
        message: ""
      },
      DetectBroken: {
        hasError: false,
        message: ""
      },
      PartInstersection: {
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
        action: "detections"
      },
      null,
      function(success) {
        try {
          success = JSON.parse(success);
        } catch (e) {
          console.error(e);
        }
        context.detections = success.configuration;
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
      action: "detections",
      BlockEncrypted: context.detections.BlockEncrypted,
      DetectBroken: context.detections.DetectBroken,
      AlgoDetection: context.detections.AlgoDetection,
      DetectStructured: context.detections.DetectStructured,
      PartInstersection: context.detections.PartInstersection,
      BlockMacros: context.detections.BlockMacros
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
input[type=radio].form-control, input[type=checkbox].form-control {
    width: 12px !important;
    height: 12px !important;
    display: inline-block;
    vertical-align: -25%;
    margin-right: 1em;
}
</style>
