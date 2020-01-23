<template>
  <div>
        
    <div class="panel panel-default">

        <div v-if="title" class="panel-heading">
          {{ title }}
          <el-button v-if="button" @click="clickButton" size="small" type="primary" icon="el-icon-check">SOLICITAR TRANSFERÊNCIA</el-button>
        </div>
        <div class="panel-body">
            <slot></slot>
        </div>
    </div>

  </div>
</template>

<script>

export default {
  name: 'input-image',
  props: {

    title: {
        required: false,
        type: [String],
        default: ''
    },
    button: {
      type: Boolean,
      default: false
    },

  },
  data () {
    return {
      txt: ''
    }
  },
  methods: {
    onRemove(file, fileList) {
        
        this.image = null;
        this.$emit('input', '');
    },
    clickButton(){

      this.$emit('clickButton');
    }

  },
}
</script>
<style>

    .panel {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 2px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        border-top: 3px solid #c1c1c1 !important;
    }

    .panel-default {
        border-color: #dee5e7;
    }

    .panel-default .panel-heading {
        font-size: 1.140rem;
        background-color: #ffffff;
        border-radius: 2px 2px 0 0;
        padding: 10px 15px;
        border-bottom: 1px solid #edf1f2;
        color: #333;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .panel-body {
        padding: 25px;
    }

    
  
</style>