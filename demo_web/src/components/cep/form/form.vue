<template>
    <div>

        <el-form @submit.native.prevent="onSubmitCep" style="min-height: 130px;" v-loading="editCep && !dados.id" :model="dados" ref="dados" label-position="top">
            <div v-if="!editCep || dados.id">

                
                <el-row :gutter="10">
                    <el-col :xs="24" :sm="4" :md="4">
                        <el-form-item label="Situação" prop="situacao" :rules="[$requiredChange]" key="situacao">
                            <el-select v-model="dados.situacao">
                                <el-option :key="true" label="ATIVO" :value="true"></el-option>
                                <el-option :key="false" label="INATIVO" :value="false"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="20" :md="20">
                        <el-form-item label="Cep" prop="cep" :rules="[$requiredBlur]" key="cep">
                            <el-input v-model="dados.cep" maxlength="191" v-on:blur="formatData('cep', 9)" v-mask="'#####-###'"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row :gutter="10">
                    <el-col :xs="24" :sm="24" :md="24">
                        <el-form-item label="Logradouro" prop="logradouro_id" :rules="[$requiredChange]" key="logradouro_id">
                            <el-select v-model="dados.logradouro_id" placeholder="pesquisar..." filterable remote :remote-method="getLogradouroByFilter" :loading="loadingLogradouro">
                                <el-option v-for="item in logradouros" :key="item.id" :label="item.nome" :value="item.id"> </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="10">
                    <el-col :xs="24" :sm="24" :md="24">
                        <el-form-item label="Bairro" prop="bairro_id" :rules="[$requiredChange]" key="bairro_id">
                            <el-select v-model="dados.bairro_id" placeholder="pesquisar..." filterable remote :remote-method="getBairroByFilter" :loading="loadingBairro">
                                <el-option v-for="item in bairros" :key="item.id" :label="item.nome" :value="item.id"> </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="10">
                    <el-col :xs="24" :sm="24" :md="24">
                        <el-form-item label="Cidade / Estado" prop="cidade_id" :rules="[$requiredChange]" key="cidade_id">
                            <el-select v-model="dados.cidade_id" placeholder="pesquisar..." filterable remote :remote-method="getCidadeByFilter" :loading="loadingCidade">
                                <el-option v-for="item in cidades" :key="item.id" :label="item.nome" :value="item.id"> </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>  

                <el-row :gutter="10">
                    <el-col :xs="24">
                        <el-form-item class="u-text-right u-mt-15">
                            <el-button type="primary" id="btn-cep" native-type="submit">SALVAR</el-button>
                        </el-form-item>
                    </el-col>
                </el-row>
                
            </div>
        </el-form>

    </div>
</template>
<script>

import Vue from 'vue'

export default {
    props: ['paramId'],
    data: () => ({
        loadingLogradouro: false,
        logradouros: [],
        loadingBairro: false,
        bairros: [],
        loadingCidade: false,
        cidades: [],
        editCep: false,
        alert: false,
        dados: {
            id: '',
            situacao: '',
            cep: ''
        }

    }),
    mounted(){

    },
    methods:{
        getLogradouroByFilter(query){

            this.$axios.post(`${this.$store.state.config.baseUrlApi}/api/logradouro/searchByNome`, {query: query}, this.$store.getters.getHeaderAuth).then(response => {

                this.logradouros = JSON.parse(JSON.stringify(response.data));

            }).catch((error) => { this.$store.commit('throwException', error); });

        },
        getBairroByFilter(query){

            this.$axios.post(`${this.$store.state.config.baseUrlApi}/api/bairro/searchByNome`, {query: query}, this.$store.getters.getHeaderAuth).then(response => {

                this.bairros = JSON.parse(JSON.stringify(response.data));

            }).catch((error) => { this.$store.commit('throwException', error); });

        },
        getCidadeByFilter(query){

            this.$axios.post(`${this.$store.state.config.baseUrlApi}/api/cidade/searchByNome`, {query: query}, this.$store.getters.getHeaderAuth).then(response => {

                this.cidades = JSON.parse(JSON.stringify(response.data));

            }).catch((error) => { this.$store.commit('throwException', error); });

        },
        getCepById(id){

            this.$axios.get(`${this.$store.state.config.baseUrlApi}/api/cep/getById/` + id, this.$store.getters.getHeaderAuth).then(response => {

                this.dados = JSON.parse(JSON.stringify(response.data));

                if(this.dados.logradouro){

                    this.logradouros.push({ id: this.dados.logradouro.id, nome: this.dados.logradouro.nome });
                }

                if(this.dados.bairro){
                    
                    this.bairros.push({ id: this.dados.bairro.id, nome: this.dados.bairro.nome });
                }

                if(this.dados.cidade){
                
                    this.cidades.push({ id: this.dados.cidade.id, nome: this.dados.cidade.nome + ' - ' + this.dados.cidade.estado.nome });
                }

            }).catch((error) => { this.$store.commit('throwException', error); });

        },
        onSubmitCep(){

            document.getElementById("btn-cep").focus();

            this.$refs.dados.validate((valid) =>{ if(valid){
 
                window.eventBus.$emit('loading', true);                

                if(this.editCep){

                    this.$axios.post(`${this.$store.state.config.baseUrlApi}/api/cep/update/` + this.dados.id, this.dados, this.$store.getters.getHeaderAuth).then(response => {

                        window.eventBus.$emit('loading', false);
                        window.eventBus.$emit('alert', {msg: 'Sucesso! - Operação realizada com Sucesso!', type: 'success'});
                        
                        this.$emit('onSubmitCep');

                    }).catch((error) => { window.eventBus.$emit('loading', false); this.$store.commit('throwException', error); });

                }else{

                    this.$axios.post(`${this.$store.state.config.baseUrlApi}/api/cep/store`, this.dados, this.$store.getters.getHeaderAuth).then(response => {
                    
                        window.eventBus.$emit('loading', false);
                        window.eventBus.$emit('alert', {msg: 'Sucesso! - Operação realizada com Sucesso!', type: 'success'});

                        this.$emit('onSubmitCep');

                    }).catch((error) => { window.eventBus.$emit('loading', false); this.$store.commit('throwException', error); });

                }

            }else{
                window.eventBus.$emit('alert', {msg: 'Campos obrigatórios não foram preenchidos.', type: 'warning'});
            }});
        },
        resetFormCep(){
          
            this.dados = { id: '', nome: '', descricao: '', ativa: '', emDestaque: null, imagem: '' };
            this.$refs.dados.clearValidate();
        },
        formatData(field, size = null){

            //TRATA OS INPUTS - LETRA MAIÚCULA 
                        
            if(!this.dados[field])
                return false;

            if(size && this.dados[field].length < size)
                this.dados[field] = '';            

            this.dados[field] = this.dados[field].toUpperCase();

        }
    },
    watch: {
        paramId: {
            immediate: true,
            handler (value) {

                if(value){

                    this.getCepById(value);
                    this.editCep = true;
                } 
            }
        },
    }
}
</script>
