<template>
    <div class="instituicao">

        <el-form @submit.native.prevent="onSubmitInstituicao" style="min-height: 200px;" v-loading="editInstituicao && !dados.id" :model="dados" ref="dados" label-position="top">
            <div v-if="!editInstituicao || dados.id">

                <c-panel>
                    <el-row :gutter="10">                    
                        <el-col :xs="24" :sm="24" :md="24">
                            <el-form-item label="Nome" prop="nome" :rules="[$requiredBlur]" key="nome">
                                <el-input v-model="dados.nome" maxlength="191" v-on:blur="formatData('nome')"></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>                    
                    <el-row :gutter="10">                    
                        <el-col :xs="24" :sm="8" :md="8">
                            <el-form-item label="CEP (cep cadastrável no menu cadastro gerais)" prop="cep" :rules="[$requiredBlur]" key="cep">
                                <el-input v-on:blur="getEnderecoByCep()" v-model="dados.cep" v-mask="'#####-###'" maxlength="191"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="24" :sm="12" :md="12">
                            <el-form-item label="Logradouro" prop="logradouro" :rules="[$requiredBlur]" key="logradouro">
                                <el-input v-model="dados.logradouro" maxlength="191" v-on:blur="formatData('logradouro')"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="24" :sm="4" :md="4">
                            <el-form-item label="N°" prop="numero" :rules="[$requiredBlur]" key="numero">
                                <el-input v-model="dados.numero" maxlength="191"></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <el-row :gutter="10">                    
                        <el-col :xs="24" :sm="24" :md="24">
                            <el-form-item label="Bairro" prop="bairro" :rules="[$requiredBlur]" key="bairro">
                                <el-input v-model="dados.bairro" maxlength="191" v-on:blur="formatData('bairro')"></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>                
                    <el-row :gutter="10">                    
                        <el-col :xs="24" :sm="12" :md="12">
                            <el-form-item label="Cidade" prop="cidade" key="cidade">
                                <el-input :readonly="true" v-model="dados.cidade" maxlength="191"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="24" :sm="12" :md="12">
                            <el-form-item label="Estado" prop="estado" key="estado">
                                <el-input :readonly="true" v-model="dados.estado" maxlength="191"></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <el-row :gutter="10">                    
                        <el-col :xs="24" :sm="12" :md="12">
                            <el-form-item label="Telefone" prop="telefone" key="telefone">
                                <el-input v-model="dados.telefone" v-mask="'(##) ########'" v-on:blur="formatData('telefone', 13)" maxlength="191"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="24" :sm="12" :md="12">
                            <el-form-item label="Celular" prop="celular" key="celular">
                                <el-input v-model="dados.celular" v-mask="'(##) #########'" v-on:blur="formatData('celular', 14)" maxlength="191"></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <el-row :gutter="10">
                        <el-col :xs="24">
                            <div class="u-text-right u-mt-15">
                                <el-button id="btn-instituicao" type="primary" native-type="submit">SALVAR</el-button>
                            </div>
                        </el-col>
                    </el-row>
                </c-panel>

            </div>
        </el-form>

    </div>
</template>
<script>

import Vue from 'vue'

export default {
    props: ['paramId'],
    data: () => ({
        editInstituicao: false,
        dados: {
            id: '',
            nome: '',
            logradouro: '',
            numero: '',
            bairro: '',
            cidade: '',
            estado: '',
            cep: '',
            telefone: '',
            celular: '',
        }        
    }),
    mounted(){
        
    },
    methods:{
        getInstituicaoById(id){

            this.$axios.get(`${this.$store.state.config.baseUrlApi}/api/instituicao/getById/` + id, this.$store.getters.getHeaderAuth).then(response => {

                this.dados = JSON.parse(JSON.stringify(response.data));

            }).catch((error) => { this.$store.commit('throwException', error); });

        },
        onSubmitInstituicao(){

            document.getElementById("btn-instituicao").focus();

            this.$refs.dados.validate((valid) =>{ if(valid){
 
                window.eventBus.$emit('loading', true);                

                if(this.editInstituicao){

                    this.$axios.post(`${this.$store.state.config.baseUrlApi}/api/instituicao/update/` + this.dados.id, this.dados, this.$store.getters.getHeaderAuth).then(response => {

                        window.eventBus.$emit('loading', false);
                        window.eventBus.$emit('alert', {msg: 'Sucesso! - Operação realizada com Sucesso!', type: 'success'});
                        
                        this.$emit('onSubmitInstituicao');

                    }).catch((error) => { window.eventBus.$emit('loading', false); this.$store.commit('throwException', error); });

                }else{

                    this.$axios.post(`${this.$store.state.config.baseUrlApi}/api/instituicao/store`, this.dados, this.$store.getters.getHeaderAuth).then(response => {
                    
                        window.eventBus.$emit('loading', false);
                        window.eventBus.$emit('alert', {msg: 'Sucesso! - Operação realizada com Sucesso!', type: 'success'});

                        this.$emit('onSubmitInstituicao');

                    }).catch((error) => { window.eventBus.$emit('loading', false); this.$store.commit('throwException', error); });

                }

            }else{
                window.eventBus.$emit('alert', {msg: 'Campos obrigatórios não foram preenchidos.', type: 'warning'});
            }});
        },
        getEnderecoByCep(){

            if(this.dados.cep.length < 9){

                this.dados.cep = '';
                return false;
            }

            this.$axios.get(`${this.$store.state.config.baseUrlApi}/api/cep/getEnderecoByCep/` + this.dados.cep.replace(/\-/g,''), this.$store.getters.getHeaderAuth).then(response => {
         
                if(response.data.length == 0){
                    
                    this.dados.cep = '';
                    this.dados.logradouro = '';
                    this.dados.bairro = '';
                    this.dados.cidade = '';
                    this.dados.estado = '';

                    window.eventBus.$emit('alert', {msg: 'Atenção! Cep inválido.', type: 'warning'});
                    return false;
                }

                this.dados.logradouro = (response.data.logradouro) ? response.data.logradouro.nome : '';
                this.dados.bairro = (response.data.bairro) ? response.data.bairro.nome : '';
                this.dados.cidade = (response.data.cidade) ? response.data.cidade.nome : '';
                this.dados.estado = (response.data.cidade) ? response.data.cidade.estado.nome : '';

            }).catch((error) => { this.$store.commit('throwException', error); });

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

                    this.getInstituicaoById(value);
                    this.editInstituicao = true;
                }

            }
        },
    }
}
</script>
