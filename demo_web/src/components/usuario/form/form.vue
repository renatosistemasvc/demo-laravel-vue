<template>
    <div>

        <el-form @submit.native.prevent="onSubmitUsuario" style="min-height: 200px;" v-loading="editUsuario && !dados.id" :model="dados" ref="dados" label-position="top">
            <div v-if="!editUsuario || dados.id">

                <el-row :gutter="10">   
                    <el-col :xs="24" :sm="18" :md="18">
                        <el-form-item label="Nome do Usuário" prop="name" :rules="[$requiredBlur]" key="name">
                            <el-input v-model="dados.name" maxlength="191" v-on:blur="formatData('name')"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="6" :md="6">
                        <el-form-item label="Situação" prop="situacao" :rules="[$requiredBlur]" key="situacao">
                            <el-select v-model="dados.situacao">
                                <el-option :key="true" label="ATIVO" :value="true"></el-option>
                                <el-option :key="false" label="INATIVO" :value="false"></el-option>                            
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>

                <div class="style-form" v-if="editUsuario && !updateUsuario">
                    <el-row :gutter="10">
                        <el-col :xs="24" :sm="24" :md="24">
                            <label style="display: block;">Usuário</label>
                            <div style="float: left; width: calc(100% - 55px);" class="style-input readonly">{{ dados.usuario }}</div>
                            <el-button style="float: right; width: 40px; height: 40px;" @click="updateUsuario = true" icon="el-icon-edit" circle></el-button>
                        </el-col>
                    </el-row>
                </div>

                <el-row :gutter="10" v-if="!editUsuario || (editUsuario && updateUsuario)">   
                    <el-col :xs="24" :sm="24" :md="24">
                        <el-form-item label="Usuário" prop="usuario" :rules="[$requiredBlur]" key="usuario">
                            <el-input class="text-transform-none" v-model="dados.usuario" maxlength="191"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                        
                <div class="style-form" v-if="editUsuario && !updatePassword">
                    <el-row :gutter="10">
                        <el-col :xs="24" :sm="24" :md="24">
                            <label style="display: block;">Senha</label>
                            <div style="float: left; width: calc(100% - 55px);" class="style-input readonly">******</div>
                            <el-button style="float: right; width: 40px; height: 40px;" @click="updatePassword = true" icon="el-icon-edit" circle></el-button>
                        </el-col>
                    </el-row>
                </div>

                <el-row :gutter="10" v-if="!editUsuario || (editUsuario && updatePassword)">   
                    <el-col :xs="24" :sm="12" :md="12">
                        <el-form-item label="Senha" prop="password" :rules="[$requiredBlur]" key="password">
                            <el-input class="text-transform-none" v-model="dados.password" maxlength="191" type="password"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="12" :md="12">
                        <el-form-item label="Confirma Senha" prop="password_confirmation" :rules="[$requiredBlur]" key="password_confirmation">
                            <el-input class="text-transform-none" v-model="dados.password_confirmation" maxlength="191" type="password"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="10">
                    <el-col :xs="24" :sm="24" :md="24">
                        <el-form-item label="Instituição" prop="instituicao_id" :rules="[$requiredBlur]" key="instituicao_id">
                            <el-select v-model="dados.instituicao_id">
                                <el-option v-for="(item, i) in instituicoes" :key="i" :label="item.nome" :value="item.id"></el-option>                          
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="10">
                    <el-col :xs="24">
                        <el-form-item class="u-text-right u-mt-15">
                            <el-button type="primary" id="btn-usuario" native-type="submit">SALVAR</el-button>
                        </el-form-item>
                    </el-col>
                </el-row>
            </div>
        </el-form>

    </div>
</template>
<script>

export default {
    props: ['paramId'],
    data: () => ({
        instituicoes: [],
        editUsuario: false,
        updateUsuario: false,
        updatePassword: false,
        alert: false,    
        dados: {
            id: '',
            name: '',
            situacao: '',
            tipo: '',
            usuario: '', 
            password: '',
            password_confirmation: '',
            instituicao_id: ''
        }

    }),
    mounted(){

        this.getAllInstituicoes();
    },
    methods:{
        getAllInstituicoes(){

            this.$axios.get(`${this.$store.state.config.baseUrlApi}/api/instituicao/getAll`, this.$store.getters.getHeaderAuth).then(response => {
                
                this.instituicoes = JSON.parse(JSON.stringify(response.data));
 
            }).catch((error) => { this.$store.commit('throwException', error); });

        },
        getUsuarioById(id){

            this.$axios.get(`${this.$store.state.config.baseUrlApi}/api/usuario/getById/` + id, this.$store.getters.getHeaderAuth).then(response => {

                this.dados = JSON.parse(JSON.stringify(response.data));
 
            }).catch((error) => { this.$store.commit('throwException', error); });

        },
        onSubmitUsuario(){

            document.getElementById("btn-usuario").focus();

            this.$refs.dados.validate((valid) =>{ if(valid){

                window.eventBus.$emit('loading', true);                

                if(this.editUsuario){

                    let dados = {
                    
                        id: this.dados.id,
                        name: this.dados.name,
                        usuario: ((this.updateUsuario) ? this.dados.usuario : ''), 
                        password: ((this.updatePassword) ? this.dados.password : ''),
                        password_confirmation: ((this.updatePassword) ? this.dados.password_confirmation : ''),
                        instituicao_id: this.dados.instituicao_id
                    };

                    this.$axios.post(`${this.$store.state.config.baseUrlApi}/api/usuario/update/` + dados.id, dados, this.$store.getters.getHeaderAuth).then(response => {

                        if(typeof response.data.throw !== 'undefined'){

                            window.eventBus.$emit('alert', {msg: response.data.throw.msg, type: response.data.throw.type});

                        }else{
                            
                            window.eventBus.$emit('alert', {msg: 'Sucesso! - Operação realizada com Sucesso!', type: 'success'});                            
                            this.$emit('onSubmitUsuario');
                        }

                        window.eventBus.$emit('loading', false);

                    }).catch((error) => { window.eventBus.$emit('loading', false); this.$store.commit('throwException', error); });

                }else{

                    this.$axios.post(`${this.$store.state.config.baseUrlApi}/api/usuario/store`, this.dados, this.$store.getters.getHeaderAuth).then(response => {
                    
                        if(typeof response.data.throw !== 'undefined'){

                            window.eventBus.$emit('alert', {msg: response.data.throw.msg, type: response.data.throw.type});

                        }else{
                            
                            window.eventBus.$emit('alert', {msg: 'Sucesso! - Operação realizada com Sucesso!', type: 'success'});                            
                            this.$emit('onSubmitUsuario');
                        }

                        window.eventBus.$emit('loading', false);

                    }).catch((error) => { window.eventBus.$emit('loading', false); this.$store.commit('throwException', error); });

                }

            }else{
                window.eventBus.$emit('alert', {msg: 'Campos obrigatórios não foram preenchidos.', type: 'warning'});
            }});
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

                    this.getUsuarioById(value);
                    this.editUsuario = true;
                } 
            }
        }
        
    }
}
</script>
<style>

    .search-instituicao .el-input__inner{
        border-radius: initial;
    }

    .titulo-list-instituicoes {
        background-color: #ccc; padding: 5px 10px;
    }

    .list-instituicoes-usuario{
        margin: 10px 0px;
    }

    .list-instituicoes-usuario .checkbox-list{    
        margin-left: 20px;
    }   

    .list-instituicoes-usuario ul {
        padding: 0;
        height: 700px;
        overflow: auto;
    }

    .list-instituicoes-usuario li {
        padding: 5px 0;
        border-bottom: 1px solid #ccc;
    }

    .list-instituicoes-usuario{
        border: 1px solid #ccc;
    }

</style>