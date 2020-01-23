<template>
    <div>

        <el-form @submit.native.prevent="onSubmitModelo" style="min-height: 130px;" v-loading="editModelo && !dados.id" :model="dados" ref="dados" label-position="top">
            <div v-if="!editModelo || dados.id">

                <el-row :gutter="10">
                    <el-col :xs="24" :sm="6" :md="6">
                        <el-form-item label="Situação" prop="situacao" :rules="[$requiredChange]" key="situacao">
                            <el-select v-model="dados.situacao">
                                <el-option :key="true" label="ATIVO" :value="true"></el-option>
                                <el-option :key="false" label="INATIVO" :value="false"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="18" :md="18">
                        <el-form-item label="Nome" prop="nome" :rules="[$requiredBlur]" key="nome">
                            <el-input v-model="dados.nome" maxlength="191" v-on:blur="formatData('nome')"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>  

                <el-row :gutter="10">
                    <el-col :xs="24">
                        <el-form-item class="u-text-right u-mt-15">
                            <el-button type="primary" id="btn-modelo" native-type="submit">SALVAR</el-button>
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
        editModelo: false,
        alert: false,
        dados: {
            id: '',
            situacao: '',
            nome: ''
        }

    }),
    mounted () {

    },
    methods:{
        getModeloById(id){

            this.$axios.get(`${this.$store.state.config.baseUrlApi}/api/modelo/getById/` + id, this.$store.getters.getHeaderAuth).then(response => {

                this.dados = JSON.parse(JSON.stringify(response.data));
 
            }).catch((error) => { this.$store.commit('throwException', error); });

        },
        onSubmitModelo(){

            document.getElementById("btn-modelo").focus();

            this.$refs.dados.validate((valid) =>{ if(valid){
 
                window.eventBus.$emit('loading', true);                

                if(this.editModelo){

                    this.$axios.post(`${this.$store.state.config.baseUrlApi}/api/modelo/update/` + this.dados.id, this.dados, this.$store.getters.getHeaderAuth).then(response => {

                        window.eventBus.$emit('loading', false);
                        window.eventBus.$emit('alert', {msg: 'Sucesso! - Operação realizada com Sucesso!', type: 'success'});
                        
                        this.$emit('onSubmitModelo');

                    }).catch((error) => { window.eventBus.$emit('loading', false); this.$store.commit('throwException', error); });

                }else{

                    this.$axios.post(`${this.$store.state.config.baseUrlApi}/api/modelo/store`, this.dados, this.$store.getters.getHeaderAuth).then(response => {
                    
                        window.eventBus.$emit('loading', false);
                        window.eventBus.$emit('alert', {msg: 'Sucesso! - Operação realizada com Sucesso!', type: 'success'});

                        this.$emit('onSubmitModelo');

                    }).catch((error) => { window.eventBus.$emit('loading', false); this.$store.commit('throwException', error); });

                }

            }else{
                window.eventBus.$emit('alert', {msg: 'Campos obrigatórios não foram preenchidos.', type: 'warning'});
            }});
        },
        resetFormModelo(){
          
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

                    this.getModeloById(value);
                    this.editModelo = true;
                } 
            }
        },
    }
}
</script>
