(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0c13d9"],{"44cf":function(e,t,a){"use strict";a.r(t);var o=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"main"},[a("c-panel",[a("form-cidade",{attrs:{paramId:e.$route.params.id},on:{onSubmitCidade:e.onSubmitCidade}})],1)],1)},s=[],i=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("el-form",{directives:[{name:"loading",rawName:"v-loading",value:e.editCidade&&!e.dados.id,expression:"editCidade && !dados.id"}],ref:"dados",staticStyle:{"min-height":"200px"},attrs:{model:e.dados,"label-position":"top"},nativeOn:{submit:function(t){return t.preventDefault(),e.onSubmitCidade(t)}}},[!e.editCidade||e.dados.id?a("div",[a("el-row",{attrs:{gutter:10}},[a("el-col",{attrs:{xs:24,sm:4,md:4}},[a("el-form-item",{key:"situacao",attrs:{label:"Situação",prop:"situacao",rules:[e.$requiredChange]}},[a("el-select",{model:{value:e.dados.situacao,callback:function(t){e.$set(e.dados,"situacao",t)},expression:"dados.situacao"}},[a("el-option",{key:!0,attrs:{label:"ATIVO",value:!0}}),a("el-option",{key:!1,attrs:{label:"INATIVO",value:!1}})],1)],1)],1),a("el-col",{attrs:{xs:24,sm:14,md:14}},[a("el-form-item",{key:"nome",attrs:{label:"Nome",prop:"nome",rules:[e.$requiredBlur]}},[a("el-input",{attrs:{maxlength:"191"},on:{blur:function(t){return e.formatData("nome")}},model:{value:e.dados.nome,callback:function(t){e.$set(e.dados,"nome",t)},expression:"dados.nome"}})],1)],1),a("el-col",{attrs:{xs:24,sm:6,md:6}},[a("el-form-item",{key:"cod_censo",attrs:{label:"Cod. Censo",prop:"cod_censo",rules:[e.$requiredBlur]}},[a("el-input",{attrs:{maxlength:"191"},on:{blur:function(t){return e.formatData("cod_censo")}},model:{value:e.dados.cod_censo,callback:function(t){e.$set(e.dados,"cod_censo",t)},expression:"dados.cod_censo"}})],1)],1)],1),a("el-row",{attrs:{gutter:10}},[a("el-col",{attrs:{xs:24,sm:24,md:24}},[a("el-form-item",{key:"estado_id",attrs:{label:"Estado",prop:"estado_id",rules:[e.$requiredChange]}},[a("el-select",{attrs:{filterable:""},model:{value:e.dados.estado_id,callback:function(t){e.$set(e.dados,"estado_id",t)},expression:"dados.estado_id"}},e._l(e.estados,(function(e,t){return a("el-option",{key:t,attrs:{label:e.nome,value:e.id}})})),1)],1)],1)],1),a("el-row",{attrs:{gutter:10}},[a("el-col",{attrs:{xs:24}},[a("el-form-item",{staticClass:"u-text-right u-mt-15"},[a("el-button",{attrs:{type:"primary",id:"btn-cidade","native-type":"submit"}},[e._v("SALVAR")])],1)],1)],1)],1):e._e()])],1)},d=[],n={props:["paramId"],data:function(){return{editCidade:!1,alert:!1,dados:{id:"",situacao:"",nome:"",cod_censo:"",estado_id:""},estados:[]}},mounted:function(){this.getAllEstados()},methods:{getAllEstados:function(){var e=this;this.$axios.get("".concat(this.$store.state.config.baseUrlApi,"/api/estado/getAll"),this.$store.getters.getHeaderAuth).then((function(t){e.estados=JSON.parse(JSON.stringify(t.data))})).catch((function(t){e.$store.commit("throwException",t)}))},getCidadeById:function(e){var t=this;this.$axios.get("".concat(this.$store.state.config.baseUrlApi,"/api/cidade/getById/")+e,this.$store.getters.getHeaderAuth).then((function(e){t.dados=JSON.parse(JSON.stringify(e.data))})).catch((function(e){t.$store.commit("throwException",e)}))},onSubmitCidade:function(){var e=this;document.getElementById("btn-cidade").focus(),this.$refs.dados.validate((function(t){t?(window.eventBus.$emit("loading",!0),e.editCidade?e.$axios.post("".concat(e.$store.state.config.baseUrlApi,"/api/cidade/update/")+e.dados.id,e.dados,e.$store.getters.getHeaderAuth).then((function(t){window.eventBus.$emit("loading",!1),window.eventBus.$emit("alert",{msg:"Sucesso! - Operação realizada com Sucesso!",type:"success"}),e.$emit("onSubmitCidade")})).catch((function(t){window.eventBus.$emit("loading",!1),e.$store.commit("throwException",t)})):e.$axios.post("".concat(e.$store.state.config.baseUrlApi,"/api/cidade/store"),e.dados,e.$store.getters.getHeaderAuth).then((function(t){window.eventBus.$emit("loading",!1),window.eventBus.$emit("alert",{msg:"Sucesso! - Operação realizada com Sucesso!",type:"success"}),e.$emit("onSubmitCidade")})).catch((function(t){window.eventBus.$emit("loading",!1),e.$store.commit("throwException",t)}))):window.eventBus.$emit("alert",{msg:"Campos obrigatórios não foram preenchidos.",type:"warning"})}))},resetFormCidade:function(){this.dados={id:"",nome:"",descricao:"",ativa:"",emDestaque:null,imagem:""},this.$refs.dados.clearValidate()},formatData:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null;if(!this.dados[e])return!1;t&&this.dados[e].length<t&&(this.dados[e]=""),this.dados[e]=this.dados[e].toUpperCase()}},watch:{paramId:{immediate:!0,handler:function(e){e&&(this.getCidadeById(e),this.editCidade=!0)}}}},r=n,l=a("2877"),c=Object(l["a"])(r,i,d,!1,null,null,null),u=c.exports,m={methods:{onSubmitCidade:function(){this.$router.push("/admin/endereco/3")}},components:{formCidade:u}},p=m,f=Object(l["a"])(p,o,s,!1,null,null,null);t["default"]=f.exports}}]);
//# sourceMappingURL=chunk-2d0c13d9.2c0445ca.js.map