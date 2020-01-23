import Vue from 'vue'  
import Vuex from 'vuex'
import axios from 'axios'
import router from '../router'

Vue.use(Vuex)

export default new Vuex.Store({  
    state: {
        token: sessionStorage.getItem("sis3569Token"),
        config: {
            baseUrlApi: process.env.VUE_APP_BASE_URL,
        },
        user: {
            imagem: '',
            name: '',
            email: '',
            tipo: '',
            instituicao: {}
        }
    },
    actions: {
        async getUser(context){

            let response = await axios.get(`${context.state.config.baseUrlApi}/api/usuario/getUsuarioLogado`, context.getters.getHeaderAuth);

            //SETA AS CREDENCIAIS DO USUÁRIO LOGADO
            context.commit('setUser', response.data);

        }        
    },
    mutations: {
        setToken(state, value){

            state.token = value;
        },
        setUser(state, value){

            state.user = value;
        },
        logout(state, value){

            router.push('/login');
            state.token = null;
            state.user = { imagem: '', name: '', email: '', tipo: '', instituicoes: [] };
            sessionStorage.removeItem('sis3569Token');
            sessionStorage.removeItem('sis3569Instituicao');
            window.eventBus = new Vue();                  
        },
        throwException(state, value) {

            console.log(String(value));
        }
    },
    getters: {   
        getHeader: state => {

            let header = {
                'Content-Type': 'application/json',
                'Accept' : 'application/json'
            }
            return header;
        },
        getHeaderAuth: state => {

            let options = {
            
                headers : {
                    'Content-Type' : 'application/json',
                    'Accept' : 'application/json',
                    'Authorization' : `Bearer ${state.token}`
                }
            
            }
            return options;
        },
        getHeaderFileAuth: state => {

            let options = {
                
                headers : {
                    'Content-Type' : ['application/json', 'multipart/form-data'],
                    'Accept' : 'application/json',
                    'Authorization' : `Bearer ${state.token}`
                }
            
            }
            return options;
        },
    }
})