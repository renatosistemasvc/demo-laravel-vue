(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-d7580bb4"],{c294:function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",[i("el-row",{staticClass:"u-mt-10 u-mb-20"},[i("el-col",{attrs:{xs:24,sm:16,md:16}},[i("el-input",{attrs:{placeholder:"Pesquisar bairro..."},nativeOn:{keyup:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:t.loadingBairros(e)}},model:{value:t.filtro["nome"],callback:function(e){t.$set(t.filtro,"nome",e)},expression:"filtro['nome']"}})],1),i("el-col",{staticClass:"u-text-right",attrs:{xs:24,sm:8,md:8}},[i("router-link",{staticClass:"btn-new-register",attrs:{to:"/admin/bairro/cadastro"}},[i("el-button",{attrs:{type:"primary"}},[t._v("NOVO BAIRRO")])],1)],1)],1),i("div",{staticClass:"container-table"},[i("table",{directives:[{name:"loading",rawName:"v-loading",value:!t.statusList,expression:"!statusList"}],staticClass:"table table-striped"},[t._m(0),i("tbody",t._l(t.items,(function(e){return i("tr",{key:e.id},[i("td",{staticClass:"hidden-mobile"},[t._v(t._s(e.id))]),i("td",[t._v(t._s(t._f("truncate")(e.nome,30,"...")))]),i("td",{staticClass:"hidden-mobile u-text-center"},[t._v(t._s(e.situacao?"Ativo":"Inativo"))]),i("td",{staticClass:"u-text-center acao"},[i("router-link",{staticClass:"link-icon",staticStyle:{color:"rgba(0, 0, 0, 0.87) !important"},attrs:{to:"/admin/bairro/edit/"+e.id}},[i("el-button",{attrs:{type:"info",title:"Editar",icon:"el-icon-edit",size:"mini"}})],1),i("el-button",{attrs:{title:"Excluir",type:"danger",icon:"el-icon-delete",size:"mini"},on:{click:function(i){return t.deleteBairro(e.id)}}})],1)])})),0),i("tfoot",[t.statusList&&0==t.items.length?i("tr",{staticStyle:{"border-top":"1px solid #ddd"}},[t._m(1)]):t._e(),t.paginate.qtdItens>10?i("tr",[i("td",{staticClass:"u-text-right",attrs:{colspan:"100%"}},[i("el-pagination",{attrs:{total:t.paginate.qtdItens,"page-size":10,background:"",layout:"prev, pager, next",small:""},on:{"current-change":t.getPagePagination}})],1)]):t._e()])])])],1)},s=[function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("thead",[i("tr",[i("th",{staticClass:"hidden-mobile",staticStyle:{width:"70px"}},[t._v("cod")]),i("th",[t._v("Nome")]),i("th",{staticClass:"hidden-mobile u-text-center"},[t._v("Situação")]),i("th",{staticClass:"u-text-center",staticStyle:{width:"150px"}},[t._v("Ação")])])])},function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("td",{staticClass:"u-text-center",attrs:{colspan:"100%"}},[i("span",[t._v("- nenhum registro -")])])}],n={data:function(){return{statusList:!1,filtro:{nome:""},paginate:{page:1,qtdItens:null},items:[]}},mounted:function(){this.loadingBairros()},methods:{loadingBairros:function(){var t=this;this.statusList=!1,this.items=[],this.$axios.post("".concat(this.$store.state.config.baseUrlApi,"/api/bairro/getAllPaginate?page=")+this.paginate.page,this.filtro,this.$store.getters.getHeaderAuth).then((function(e){t.items=e.data.data,t.paginate.qtdItens=e.data.total,t.statusList=!0})).catch((function(e){t.$store.commit("throwException",e)}))},deleteBairro:function(t){var e=this;this.$msgbox.confirm("Tem certeza que deseja excluir esta bairro?","Atenção",{confirmButtonText:"Sim",cancelButtonText:"Não",type:"warning"}).then((function(){window.eventBus.$emit("loading",!0),e.$axios.delete("".concat(e.$store.state.config.baseUrlApi,"/api/bairro/delete/")+t,e.$store.getters.getHeaderAuth).then((function(t){window.eventBus.$emit("loading",!1),window.eventBus.$emit("alert",{msg:"Sucesso! - Operação realizada com Sucesso!",type:"success"}),e.loadingBairros()})).catch((function(t){window.eventBus.$emit("loading",!1),e.$store.commit("throwException",t)}))})).catch((function(){}))},getPagePagination:function(t){this.paginate.page=t,this.loadingBairros()}}},o=n,r=i("2877"),l=Object(r["a"])(o,a,s,!1,null,null,null);e["a"]=l.exports},cd7c:function(t,e,i){"use strict";i.r(e);var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"main"},[i("c-panel",[i("list")],1)],1)},s=[],n=i("c294"),o={components:{list:n["a"]}},r=o,l=i("2877"),c=Object(l["a"])(r,a,s,!1,null,null,null);e["default"]=c.exports}}]);
//# sourceMappingURL=chunk-d7580bb4.b79e9203.js.map