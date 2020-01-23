<template>
    <div>
        <el-row class="u-mt-10 u-mb-20">
            <el-col :xs="24" :sm="16" :md="16">
                <el-input v-model="filtro['nome']" placeholder="Pesquisar cep..." @keyup.native.enter="loadingCeps"></el-input>
            </el-col>
            <el-col :xs="24" :sm="8" :md="8" class="u-text-right">
                <router-link to="/admin/cep/cadastro" class="btn-new-register">
                    <el-button type="primary">NOVO CEP</el-button>
                </router-link>
            </el-col>
        </el-row>
        <div class="container-table">
            <table v-loading="!statusList" class="table table-striped">
                <thead>
                    <tr>
                        <th class="hidden-mobile" style="width: 70px;">cod</th>
                        <th>Cep</th>
                        <th>Logradouro</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                        <th class="hidden-mobile u-text-center">Situação</th>
                        <th style="width: 150px;" class="u-text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in items" :key="item.id">
                        <td class="hidden-mobile">{{ item.id }}</td>
                        <td>{{ item.cep }}</td>
                        <td>{{ item.logradouro.nome }}</td>
                        <td>{{ item.bairro.nome }}</td>
                        <td>{{ item.cidade.nome }}</td>
                        <td class="hidden-mobile u-text-center">{{ (item.situacao) ? 'Ativo' : 'Inativo' }}</td>
                        <td class="u-text-center acao"> 
                            <router-link :to="'/admin/cep/edit/'+ item.id" class="link-icon" style="color: rgba(0, 0, 0, 0.87) !important;">
                                <el-button type="info" title="Editar" icon="el-icon-edit" size="mini"></el-button>
                            </router-link>
                            <el-button @click="deleteCep(item.id)" title="Excluir" type="danger" icon="el-icon-delete" size="mini"></el-button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr v-if="statusList && items.length == 0" style="border-top: 1px solid #ddd;">
                        <td colspan="100%" class="u-text-center">
                            <span>- nenhum registro -</span>
                        </td>
                    </tr>
                    <tr v-if="paginate.qtdItens > 10">
                        <td colspan="100%" class="u-text-right">
                            <el-pagination :total="paginate.qtdItens" @current-change="getPagePagination" :page-size="10" background layout="prev, pager, next" small></el-pagination>
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
        statusList: false,
        filtro: {
            cep: ''
        },
        paginate: {
            page: 1,
            qtdItens: null,
        },
        items: [ ]
    }),
    mounted () {
      this.loadingCeps()
    },
    methods: {
        loadingCeps(){

            this.statusList = false;
            this.items = [];

            this.$axios.post(`${this.$store.state.config.baseUrlApi}/api/cep/getAllPaginate?page=` + this.paginate.page, this.filtro, this.$store.getters.getHeaderAuth).then(response => {

                this.items = response.data.data;
                this.paginate.qtdItens = response.data.total;
                this.statusList = true;

            }).catch((error) => { this.$store.commit('throwException', error); });

        },
        deleteCep(id){

            this.$msgbox.confirm('Tem certeza que deseja excluir esta cep?', 'Atenção', { confirmButtonText: 'Sim', cancelButtonText: 'Não', type: 'warning' }).then(() => {

                window.eventBus.$emit('loading', true);
                    
                this.$axios.delete(`${this.$store.state.config.baseUrlApi}/api/cep/delete/` + id, this.$store.getters.getHeaderAuth).then(response => {
                            
                    window.eventBus.$emit('loading', false);
                    window.eventBus.$emit('alert', {msg: 'Sucesso! - Operação realizada com Sucesso!', type: 'success'});
                    this.loadingCeps();

                }).catch((error) => { window.eventBus.$emit('loading', false); this.$store.commit('throwException', error); });

            }).catch(()=>{});

        },
        getPagePagination(page){
          this.paginate.page = page;
          this.loadingCeps();
        }
    }
}
</script>