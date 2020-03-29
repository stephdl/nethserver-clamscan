<template>
   <div> <!-- Do not remove :( -->
  <h2>{{$t('pua.title')}}</h2>
  <h3>{{$t('pua.PUA_are_applications_that_can_be_used_in_an_unwanted context')}}</h3>
  <div v-if="!view.isLoaded" class="spinner spinner-lg"></div>
  <div v-if="view.isLoaded">
  <form class="form-horizontal" v-on:submit.prevent="saveSettings('status')">
    <div
      :class="['form-group', errors.DetectPua.hasError ? 'has-error' : '']"
    >
      <label
        class="col-sm-2 control-label"
        for="textInput-modal-markup"
      >{{$t('pua.DetectPua')}}
      <doc-info
        :placement="'right'"
        :title="$t('pua.DetectPua')"
        :chapter="'DetectPua'"
        :inline="true"
      ></doc-info>
      </label>
      <div class="col-sm-5">
          <input
            type="checkbox"
            true-value="enabled"
            false-value="disabled"
            v-model="pua.DetectPua"
            class="form-control"
            @change="togglePua()"
          >
        <span
          v-if="errors.DetectPua.hasError"
          class="help-block"
        >{{errors.DetectPua.message}}</span>
      </div>
    </div>
    <div v-if="view.togglePua">
      <div class="form-group">
        <label
          class="col-sm-2 control-label"
          for="textInput-modal-markup"
          >{{$t('pua.Packed')}}
          <doc-info
            :placement="'right'"
            :title="$t('pua.Packed')"
            :chapter="'Packed'"
            :inline="true"
          ></doc-info>
          </label>
          <div class="col-sm-5">
            <input
            type="checkbox"
            value="Packed"
            v-model="pua.IncludePua"
            class="form-control"
            >
            <span
            v-if="errors.IncludePua.hasError"
            class="help-block"
            >{{errors.IncludePua.message}}</span>
          </div>
        </div>
      <div class="form-group">
        <label
          class="col-sm-2 control-label"
          for="textInput-modal-markup"
          >{{$t('pua.PwTool')}}
          <doc-info
            :placement="'right'"
            :title="$t('pua.PwTool')"
            :chapter="'PwTool'"
            :inline="true"
          ></doc-info>
          </label>
          <div class="col-sm-5">
            <input
            type="checkbox"
            value="PwTool"
            v-model="pua.IncludePua"
            class="form-control"
            >
            <span
            v-if="errors.IncludePua.hasError"
            class="help-block"
            >{{errors.IncludePua.message}}</span>
          </div>
        </div>
      <div class="form-group">
        <label
          class="col-sm-2 control-label"
          for="textInput-modal-markup"
          >{{$t('pua.NetTool')}}
          <doc-info
            :placement="'right'"
            :title="$t('pua.NetTool')"
            :chapter="'NetTool'"
            :inline="true"
          ></doc-info>
          </label>
          <div class="col-sm-5">
            <input
            type="checkbox"
            value="NetTool"
            v-model="pua.IncludePua"
            class="form-control"
            >
            <span
            v-if="errors.IncludePua.hasError"
            class="help-block"
            >{{errors.IncludePua.message}}</span>
          </div>
        </div>
      <div class="form-group">
        <label
          class="col-sm-2 control-label"
          for="textInput-modal-markup"
          >{{$t('pua.P2P')}}
          <doc-info
            :placement="'right'"
            :title="$t('pua.P2P')"
            :chapter="'P2P'"
            :inline="true"
          ></doc-info>
          </label>
          <div class="col-sm-5">
            <input
            type="checkbox"
            value="P2P"
            v-model="pua.IncludePua"
            class="form-control"
            >
            <span
            v-if="errors.IncludePua.hasError"
            class="help-block"
            >{{errors.IncludePua.message}}</span>
          </div>
        </div>
      <div class="form-group">
        <label
          class="col-sm-2 control-label"
          for="textInput-modal-markup"
          >{{$t('pua.IRC')}}
          <doc-info
            :placement="'right'"
            :title="$t('pua.IRC')"
            :chapter="'IRC'"
            :inline="true"
          ></doc-info>
          </label>
          <div class="col-sm-5">
            <input
            type="checkbox"
            value="IRC"
            v-model="pua.IncludePua"
            class="form-control"
            >
            <span
            v-if="errors.IncludePua.hasError"
            class="help-block"
            >{{errors.IncludePua.message}}</span>
          </div>
        </div>
      <div class="form-group">
        <label
          class="col-sm-2 control-label"
          for="textInput-modal-markup"
          >{{$t('pua.RAT')}}
          <doc-info
            :placement="'right'"
            :title="$t('pua.RAT')"
            :chapter="'RAT'"
            :inline="true"
          ></doc-info>
          </label>
          <div class="col-sm-5">
            <input
            type="checkbox"
            value="RAT"
            v-model="pua.IncludePua"
            class="form-control"
            >
            <span
            v-if="errors.IncludePua.hasError"
            class="help-block"
            >{{errors.IncludePua.message}}</span>
          </div>
        </div>
      <div class="form-group">
        <label
          class="col-sm-2 control-label"
          for="textInput-modal-markup"
          >{{$t('pua.Tool')}}
          <doc-info
            :placement="'right'"
            :title="$t('pua.Tool')"
            :chapter="'Tool'"
            :inline="true"
          ></doc-info>
          </label>
          <div class="col-sm-5">
            <input
            type="checkbox"
            value="Tool"
            v-model="pua.IncludePua"
            class="form-control"
            >
            <span
            v-if="errors.IncludePua.hasError"
            class="help-block"
            >{{errors.IncludePua.message}}</span>
          </div>
        </div>
      <div class="form-group">
        <label
          class="col-sm-2 control-label"
          for="textInput-modal-markup"
          >{{$t('pua.Spy')}}
          <doc-info
            :placement="'right'"
            :title="$t('pua.Spy')"
            :chapter="'Spy'"
            :inline="true"
          ></doc-info>
          </label>
          <div class="col-sm-5">
            <input
            type="checkbox"
            value="Spy"
            v-model="pua.IncludePua"
            class="form-control"
            >
            <span
            v-if="errors.IncludePua.hasError"
            class="help-block"
            >{{errors.IncludePua.message}}</span>
          </div>
        </div>
      <div class="form-group">
        <label
          class="col-sm-2 control-label"
          for="textInput-modal-markup"
          >{{$t('pua.Server')}}
          <doc-info
            :placement="'right'"
            :title="$t('pua.Server')"
            :chapter="'Server'"
            :inline="true"
          ></doc-info>
          </label>
          <div class="col-sm-5">
            <input
            type="checkbox"
            value="Server"
            v-model="pua.IncludePua"
            class="form-control"
            >
            <span
            v-if="errors.IncludePua.hasError"
            class="help-block"
            >{{errors.IncludePua.message}}</span>
          </div>
        </div>
      <div class="form-group">
        <label
          class="col-sm-2 control-label"
          for="textInput-modal-markup"
          >{{$t('pua.Script')}}
          <doc-info
            :placement="'right'"
            :title="$t('pua.Script')"
            :chapter="'Script'"
            :inline="true"
          ></doc-info>
          </label>
          <div class="col-sm-5">
            <input
            type="checkbox"
            value="Script"
            v-model="pua.IncludePua"
            class="form-control"
            >
            <span
            v-if="errors.IncludePua.hasError"
            class="help-block"
            >{{errors.IncludePua.message}}</span>
          </div>
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
  name: "Pua",
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
      togglePua: false
    },
    advanced: false,
    pua: {
      DetectPua: "disabled",
      IncludePua: []
    },
    loaders: false,
    errors: this.initErrors()
  };
},
methods: {
  initErrors() {
    return {
      DetectPua: {
        hasError: false,
        message: ""
      },
      IncludePua: {
        hasError: false,
        message: ""
      }
    };
  },
    togglePua() {
    this.view.togglePua = !this.view.togglePua;
    this.$forceUpdate();
  },
  getSettings() {
    var context = this;
    context.view.isLoaded = false;
    context.advanced = false;
    
    nethserver.exec(
      ["nethserver-clamscan/read"],
      {
        action: "pua"
      },
      null,
      function(success) {
        try {
          success = JSON.parse(success);
        } catch (e) {
          console.error(e);
        }
        context.pua = success.configuration;
        if (context.pua.DetectPua === 'enabled') {
            context.view.togglePua = true;
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
      action: "pua",
      IncludePua: context.pua.IncludePua.join(','),
      DetectPua: context.pua.DetectPua
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
