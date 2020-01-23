<template>
    <div>
        <el-row class="u-mt-10 u-mb-20">
            <el-col :xs="24" :sm="16" :md="16">
                <el-input v-model="filtro.nome" placeholder="Pesquisar instituicao..." @keyup.native.enter="loadingInstituicoes"></el-input>
            </el-col>
            <el-col :xs="24" :sm="8" :md="8" class="u-text-right">
                <router-link to="/admin/instituicao/cadastro" class="btn-new-register">
                    <el-button type="primary">NOVA INSTITUIÇÃO</el-button>
                </router-link>
            </el-col>
        </el-row>
        <div class="container-table">
            <table v-loading="!statusList" class="table table-striped">
                <thead>
                    <tr>
                        <th class="hidden-mobile" style="width: 70px;">cod</th>
                        <th>Nome</th>                        
                        <th>Bairro</th>
                        <th style="width: 150px;" class="u-text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in items" :key="item.id">
                        <td class="hidden-mobile">{{ item.id }}</td>
                        <td>{{ item.nome | truncate(70, '...') }}</td>
                        <td>{{ item.bairro | truncate(30, '...') }}</td>
                        <td class="u-text-center acao">
                            <router-link :to="'instituicao/edit/' + item.id" class="link-icon" style="color: rgba(0, 0, 0, 0.87) !important;">
                                <el-button type="info" title="Editar" icon="el-icon-edit" size="mini"></el-button>
                            </router-link>
                            <el-button @click="deleteInstituicao(item.id)" title="Excluir" type="danger" icon="el-icon-delete" size="mini"></el-button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr v-if="statusList && items.length == 0" style="border-top: 1px solid #ddd;">
                        <td colspan="100%" class="u-text-center">
                            <span>- nenhum registro -</span>
                        </td>
                    </tr>
                    <tr v-if="qtdItens > 15">
                        <td colspan="100%" class="u-text-right">
                            <el-pagination :total="qtdItens" @current-change="getPagePagination" :page-size="15" background layout="prev, pager, next" small></el-pagination>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>        
    </div>
</template>
<script>

export default {
    data: () => ({
        dialogInfoInstituicao: false,
        statusList: false,
        filtro: {
            nome: ''
        },
        page: 1,
        qtdItens: null,
        items: [ ],
        info: { id: '1' }
    }),
    mounted () {
      this.loadingInstituicoes()
    },
    methods: {
        loadingInstituicoes(){

            this.statusList = false;
            this.items = [];

            this.$axios.post(`${this.$store.state.config.baseUrlApi}/api/instituicao/getAllPaginate?page=` + this.page, this.filtro, this.$store.getters.getHeaderAuth).then(response => {

                this.items = response.data.data;
                this.qtdItens = response.data.total;
                this.statusList = true;

            }).catch((error) => { this.$store.commit('throwException', error); });

        },
        deleteInstituicao(id){

            this.$msgbox.confirm('Tem certeza que deseja continuar?', 'Atenção', { confirmButtonText: 'Sim', cancelButtonText: 'Não', type: 'warning' }).then(() => {

                window.eventBus.$emit('loading', true);
                    
                this.$axios.delete(`${this.$store.state.config.baseUrlApi}/api/instituicao/delete/` + id, this.$store.getters.getHeaderAuth).then(response => {
                            
                    if(typeof response.data.throw !== 'undefined'){

                        window.eventBus.$emit('loading', false);
                        window.eventBus.$emit('alert', {msg: response.data.throw.msg, type: response.data.throw.type});

                    }else{

                        window.eventBus.$emit('loading', false);
                        window.eventBus.$emit('alert', {msg: 'Sucesso! - Operação realizada com Sucesso!', type: 'success'});
                        this.loadingInstituicoes();
                    }

                }).catch((error) => { window.eventBus.$emit('loading', false); this.$store.commit('throwException', error); });

            }).catch(()=>{});
        },
        getPagePagination(page){
          this.page = page;
          this.loadingInstituicoes();
        }        
    }
}
</script>