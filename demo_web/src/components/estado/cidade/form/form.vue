<template>
    <div>

        <el-form @submit.native.prevent="onSubmitCidade" style="min-height: 200px;" v-loading="editCidade && !dados.id" :model="dados" ref="dados" label-position="top">
            <div v-if="!editCidade || dados.id">

                <el-row :gutter="10">
                    <el-col :xs="24" :sm="4" :md="4">
                        <el-form-item label="Situação" prop="situacao" :rules="[$requiredChange]" key="situacao">
                            <el-select v-model="dados.situacao">
                                <el-option :key="true" label="ATIVO" :value="true"></el-option>
                                <el-option :key="false" label="INATIVO" :value="false"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="14" :md="14">
                        <el-form-item label="Nome" prop="nome" :rules="[$requiredBlur]" key="nome">
                            <el-input v-model="dados.nome" maxlength="191" v-on:blur="formatData('nome')"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="6" :md="6">
                        <el-form-item label="Cod. Censo" prop="cod_censo" :rules="[$requiredBlur]" key="cod_censo">
                            <el-input v-model="dados.cod_censo" maxlength="191" v-on:blur="formatData('cod_censo')"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>  
                <el-row :gutter="10">
                    <el-col :xs="24" :sm="24" :md="24">
                        <el-form-item label="Estado" prop="estado_id" :rules="[$requiredChange]" key="estado_id">
                            <el-select v-model="dados.estado_id" filterable>
                                <el-option v-for="(item, i) in estados" :key="i" :label="item.nome" :value="item.id"></el-option>                              
                            </el-select>
                        </el-form-item>
                    </el-col>                
                </el-row>

                <el-row :gutter="10">
                    <el-col :xs="24">
                        <el-form-item class="u-text-right u-mt-15">
                            <el-button type="primary" id="btn-cidade" native-type="submit">SALVAR</el-button>
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
        editCidade: false,
        alert: false,
        dados: {
            id: '',
            situacao: '',
            nome: '',
            cod_censo: '',
            estado_id: ''
        },
        estados: []

    }),
    mounted () {

        this.getAllEstados();
    },
    methods:{
        getAllEstados(){

            this.$axios.get(`${this.$store.state.config.baseUrlApi}/api/estado/getAll`, this.$store.getters.getHeaderAuth).then(response => {

                this.estados = JSON.parse(JSON.stringify(response.data));
 
            }).catch((error) => { this.$store.commit('throwException', error); });

        },
        getCidadeById(id){

            this.$axios.get(`${this.$store.state.config.baseUrlApi}/api/cidade/getById/` + id, this.$store.getters.getHeaderAuth).then(response => {

                this.dados = JSON.parse(JSON.stringify(response.data));
 
            }).catch((error) => { this.$store.commit('throwException', error); });

        },
        onSubmitCidade(){

            document.getElementById("btn-cidade").focus();

            this.$refs.dados.validate((valid) =>{ if(valid){
 
                window.eventBus.$emit('loading', true);                

                if(this.editCidade){

                    this.$axios.post(`${this.$store.state.config.baseUrlApi}/api/cidade/update/` + this.dados.id, this.dados, this.$store.getters.getHeaderAuth).then(response => {

                        window.eventBus.$emit('loading', false);
                        window.eventBus.$emit('alert', {msg: 'Sucesso! - Operação realizada com Sucesso!', type: 'success'});
                        
                        this.$emit('onSubmitCidade');

                    }).catch((error) => { window.eventBus.$emit('loading', false); this.$store.commit('throwException', error); });

                }else{

                    this.$axios.post(`${this.$store.state.config.baseUrlApi}/api/cidade/store`, this.dados, this.$store.getters.getHeaderAuth).then(response => {
                    
                        window.eventBus.$emit('loading', false);
                        window.eventBus.$emit('alert', {msg: 'Sucesso! - Operação realizada com Sucesso!', type: 'success'});

                        this.$emit('onSubmitCidade');

                    }).catch((error) => { window.eventBus.$emit('loading', false); this.$store.commit('throwException', error); });

                }

            }else{
                window.eventBus.$emit('alert', {msg: 'Campos obrigatórios não foram preenchidos.', type: 'warning'});
            }});
        },
        resetFormCidade(){
          
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

                    this.getCidadeById(value);
                    this.editCidade = true;
                } 
            }
        },
    }
}
</script>
