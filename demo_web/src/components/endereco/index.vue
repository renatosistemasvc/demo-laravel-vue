<template>
    
    <div class="main">
        <el-tabs type="border-card" v-model="tabAtiva">
            <el-tab-pane label="LOGRADOURO" name="0">

                <list-logradouro></list-logradouro>

            </el-tab-pane>
            <el-tab-pane label="BAIRRO" name="1">

                <list-bairro></list-bairro>

            </el-tab-pane>
            <el-tab-pane label="ESTADO" name="2">
                
                <list-estado></list-estado>

            </el-tab-pane>
            <el-tab-pane label="CIDADE" name="3">
                
                <list-cidade></list-cidade>

            </el-tab-pane>   
            <el-tab-pane label="CEP / ENDEREÇO" name="4">
                
                <list-cep></list-cep>

            </el-tab-pane>         
        </el-tabs>
    </div>
    
</template>
<script>

import listCep from "../cep/list/list";
import listLogradouro from "../logradouro/list/list";
import listBairro from "../bairro/list/list";
import listCidade from "../cidade/list/list";
import listEstado from "../estado/list/list";

export default {
    data: () => ({
        tabAtiva: 0

    }),
    mounted(){ 

        this.tabAtiva = (this.$route.params.tab) ? this.$route.params.tab : 0;

    },
    methods:{
        tabSelected(){

        }
    },
    components:{ listCep, listLogradouro, listBairro, listCidade, listEstado }
}
</script>
