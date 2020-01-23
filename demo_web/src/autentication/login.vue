<template>
    <div class="container-login">
        

        <div class="bloco-form reset-text-transform">

            <div class="form-login">
                <h2 class="title-login">
                    <i class="far fa-user"></i>
                    Autentique-se.
                </h2>
                
                <el-form @submit.native.prevent="onSubmitLogin" :model="dados" ref="dados" label-position="top">
                    <el-row :gutter="10">
                        <el-col :xs="24" :sm="24" :md="24">
                            <el-form-item prop="username" :rules="[$requiredBlur]" key="username">
                                <el-input id="username" placeholder="Usuário" v-model="dados.username"></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <el-row :gutter="10">
                        <el-col :xs="24" :sm="24" :md="24">
                            <el-form-item prop="password" :rules="[$requiredBlur]" key="password">
                                <el-input id="password" placeholder="Senha" type="password" v-model="dados.password"></el-input>
                            </el-form-item>
                        </el-col> 
                    </el-row>
                    <el-row :gutter="10">
                        <el-col :xs="24" :sm="24" :md="24" class="u-text-right">
                            <el-button type="primary" native-type="submit">ENTRAR</el-button>
                        </el-col> 
                    </el-row>
                </el-form>
            </div>
            <p style="color: #fff;">
                    USUÁRIO: admin<br>
                    PASSWORD: 123123
                </p>

        </div>
        
    </div>
</template>
<script>

import axios from 'axios'

export default {
  data() {
      return {
          dados: {
              username: '',
              password: ''
          },
      };
  },
  mounted () {

      sessionStorage.removeItem('sis3569Instituicao');
      sessionStorage.removeItem('sis3569Token');
  },
  methods: {

    onSubmitLogin() {

        this.$refs.dados.validate((valid) =>{ if(valid){
                          
            axios.post(`${this.$store.state.config.baseUrlApi}/oauth/token`, this.dados, this.$store.getters.getHeader).then(response => {
                
                //SETA O TOKEN NO VUEX
                this.$store.commit('setToken', response.data.access_token);
                
                //SETA O TOKEN NO STORAGE (CASO DÊ O REFRESH NA PAG CONTINUA LOGADO)
                sessionStorage.setItem('sis3569Token', response.data.access_token);

                //REDIRECIONA PARA O PAINEL ADM
                this.$router.push('admin'); 
            
            }).catch((error) => {
                
                try{
                    
                    if(error.response.status == '401'){

                        this.$message({
                            message: 'Erro! Usuário não autorizado.',
                            type: 'error',
                            duration: 5000
                        });

                    }else if(error.response.status == '429'){

                        this.$message({
                            message: 'Erro! Demasiadas solicitações em curto período de tempo.',
                            type: 'error',
                            duration: 5000
                        });

                    }else{

                        this.$message({
                            message: 'Erro! Não foi possível realizar o login.',
                            type: 'error',
                            duration: 5000
                        });

                    }
                                    
                }catch(e){ 

                    this.$message({
                        message: 'Erro! Não foi possível realizar o login.',
                        type: 'error',
                        duration: 5000
                    });

                }

            });
        }});
      }
  },
};
</script>


