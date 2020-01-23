<template>
  <div>    
    
    <div>
      <div>      
          <div class="tarja-header">
            
            <div class="logo" :style="{'width': ((collapsed || isMobile) ? '60px' : '240px') }">
              <router-link to="/">
                <div v-if="!collapsed && !isMobile" style="display: flex; color: #ffff; font-size: 13px;">
                  DEMONSTRAÇÃO
                </div>
                <div v-if="collapsed || isMobile"></div>
              </router-link>
            </div>

            <div class="btn-hidden-menu" @click="btnHiddenMenu = !btnHiddenMenu">
              <i class="fa fa-bars"></i>
            </div>

            <ul class="menu-tarja-right">
              <li class="imagem-avatar">
                <div class="item">
                  <el-dropdown trigger="click" @command="clickSubMenu">
                    <span class="el-dropdown-link">
                      <span class="avatar">

                        <img v-if="$store.state.user.imagem" :src="$store.state.user.imagem  | image('40x40/filters:max_bytes(102400)')" />
                        <img v-if="!$store.state.user.imagem" src="@/assets/img/sem-foto-perfil.jpg">
                      </span>
                    </span>
                    <el-dropdown-menu slot="dropdown" class="menu-sign">
                      <el-dropdown-item>
                        <i class="fa fa-user-circle"></i><span>{{ $store.state.user.name }}</span>
                      </el-dropdown-item>
                       <el-dropdown-item command="logout" divided>
                        <i class="fa fa-sign-out-alt"></i><span>Sair</span>
                      </el-dropdown-item>
                    </el-dropdown-menu>
                  </el-dropdown>
                </div>
              </li>
            </ul>
          </div>
          
          <div id="collapsed" :class="{'collapsed' : collapsed}">
            <sidebar-menu :menu="menu" :collapsed="collapsed" :isMobile="isMobile" :btnHiddenMenu="btnHiddenMenu" @collapse="onCollapse" @mobile="onMobile"/>
            <div class="sub-tarja-header" v-if="$route.meta.title != 'Página Inicial'">
              <h1>{{ $route.meta.title }}</h1>
              <el-breadcrumb style="margin-top: 5px;" separator="/">
                <el-breadcrumb-item v-for="item in $route.meta.breadcrumb" :key="item.name" :to="{ path: item.url }">{{ item.txt }}</el-breadcrumb-item>
              </el-breadcrumb>          
            </div>          
            <router-view/>
          </div>
      </div>
    </div>

    <el-dialog title="DOCUMENTO" :close-on-click-modal="false" :visible.sync="dialogPrint" width="80%" top="5vh" class="ss-header-dialog-print">
        <div v-if="dialogPrint">
          <iframe ref="myDiv"  id="iframe" scrolling="no" style="width: 100%; height: 130vh; border: none;" src="" >
            <p>Relatório indisponível! Seu navegador não é compatível.</p>
          </iframe>
        </div>
    </el-dialog>

    <el-dialog class="ss-loading" top="0" width="200px" :visible.sync="loading" :close-on-click-modal="false" :close-on-press-escape="false" :show-close="false" center>
        <div style="text-align: center;">
          <img src="/public/img/loading.gif" />
        </div>
    </el-dialog>

    <el-dialog title="ATENÇÃO" :close-on-click-modal="false" :visible.sync="dialogValid" top="15vh" width="28%"  class="ss-header-valid">
        <div v-if="dialogValid">
          <ul>
            <li v-for="(item, i) in valid" :key="i">
              {{ item.msg }}
            </li>
          </ul>
          <div class="btn-valid">
            <el-button type="primary" @click="dialogValid = false">Ok</el-button>
          </div>
        </div>
    </el-dialog>

  </div>
</template>
<script>

import { SidebarMenu } from './menu'

export default {
  name: "index",
  data: () => ({
    valid: [],
    dialogValid: false,
    btnHiddenMenu: true,
    dialogPrint: false,
    loading: null,
    menu: [

      { header: true, title: 'Menu' },
      { href: '/admin/instituicao', title: 'Instituições', icon: 'far fa-copy' },
      { href: '/admin/usuario', title: 'Usuário', icon: 'far fa-user-circle' }, 
      { 
        title: 'Cadastros Gerais', icon: 'fa fa-sitemap', child: 
        [
          { href: '/admin/endereco', title: 'Endereço', icon: 'fa fa-list-alt' },
        ]
      },
      
    ],
    collapsed: false,
    isMobile: false
    
  }),
  async mounted(){
   
    this.$store.dispatch('getUser');
  },
  methods: {
    onCollapse(val) {
      this.collapsed = val
    },
    onMobile(val) {
      this.isMobile = val
    },
    clickSubMenu(clicado){

      if(clicado){

        if(clicado == 'logout'){

          this.logout();

        }else if(clicado == 'update-instituicao'){
            
          this.$store.commit('setInstituicao', false);

        }else if(clicado == 'perfil'){

          this.$router.push('/admin/perfil');

        }
      }

    },
    logout(){

      this.$store.commit('logout');
    }
  },
  created: function(){
   
      window.eventBus.$on('alert', data =>  {

          let time = 3000;

          if(data.type == 'error' || data.type == 'warning')
            time = 6000;
          
          this.$message({
            message: data.msg,
            type: data.type,
            duration: time
          });

      });

      window.eventBus.$on('loading', data =>  {

          this.loading = data;
      });

      window.eventBus.$on('print', data =>  {
         
          this.dialogPrint = true; 

          setTimeout(()=>{  

            let iframe = this.$refs.myDiv
            let url = this.$store.state.config.baseUrlApi + data.url;

            var param = new FormData();
            param.append("param", JSON.stringify(data.param));

            let headers = [['Authorization', 'Bearer ' + sessionStorage.getItem("sis3569Token")]];

            var xhr = new XMLHttpRequest();

            xhr.open('POST', url, true);
            xhr.onreadystatechange = handler;
            xhr.responseType = 'blob';
            headers.forEach(function(header) {
              xhr.setRequestHeader(header[0], header[1]);
            });
            xhr.send(param);

            function handler() {
              if (this.readyState === this.DONE) {
                if (this.status === 200) {
                  iframe.src = URL.createObjectURL(this.response);
                } else {
                  console.error('XHR failed', this);
                }
              }
            }
            
          }, 1000);
      });

      window.eventBus.$on('throw', data =>  {

          console.log(data);

          this.dialogValid = true;
          this.valid = data;
      });

  },
  components: {
    SidebarMenu
  }
};
</script>
