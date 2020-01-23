<template lang="html">
  <div class="el-input el-input--small">
    <input type="tel"
          :value="formattedValue"
          v-on:blur="onBlur"
          @change="change"
          v-money="{precision, decimal, thousands, prefix, suffix}"
          class="el-input__inner money" 
          maxlength="16"/>
  </div>
</template>

<script>
import money from './directive'
import defaults from './options'
import {format, unformat} from './utils'

export default {
  name: 'Money',
  props: {
    value: {
      required: true,
      default: 0
    },
    masked: {
      type: Boolean,
      default: false
    },
    precision: {
      type: Number,
      default: () => defaults.precision
    },
    decimal: {
      type: String,
      default: () => defaults.decimal
    },
    thousands: {
      type: String,
      default: () => defaults.thousands
    },
    prefix: {
      type: String,
      default: () => defaults.prefix
    },
    suffix: {
      type: String,
      default: () => defaults.suffix
    }
  },

  directives: {money},

  data () {
    return {
      formattedValue: null
    }
  },

  watch: {
    value: {
      immediate: true,
      handler (newValue, oldValue) {

        if(!newValue){
          var formatted = null;
        }else{
          var formatted = format(newValue, this.$props)
        }
       
        if (formatted !== this.formattedValue) {
          this.formattedValue = formatted
        }
      }
    }
  },

  methods: {
    change (evt) {

      this.$emit('input', this.masked ? evt.target.value : ( (!evt.target.value) ? null : unformat(evt.target.value, this.precision)))
    },
    onBlur(){
      this.$emit('onBlur', true)
    }
  }
}
</script>
