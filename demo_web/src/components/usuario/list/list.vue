<template>
    <div>
        <el-form class="u-mb-20">
            <el-row :gutter="10" class="u-mt-10 u-mb-20">
                <el-col :xs="24" :sm="10" :md="10">
                    <el-form-item>
                        <el-input placeholder="Buscar pelo nome" v-model="filtro['name']" @keyup.native.enter="loadingUsuarios"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :xs="24" :sm="14" :md="14" class="u-text-right">
                    <router-link to="/admin/usuario/cadastro" style="display: inline-block;">
                        <el-button type="primary">NOVO USUÁRIO</el-button>
                    </router-link>
                </el-col>
            </el-row>
        </el-form>
        <div class="container-table">
            <table v-loading="!statusList" class="table table-striped">
                <thead>
                    <tr>
                        <th class="hidden-mobile" style="width: 70px;">cod</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th style="width: 150px;" class="u-text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in items" :key="item.id">
                        <td class="hidden-mobile">{{ item.id }}</td>
                        <td>{{ item.name | truncate(30, '...') }}</td>
                        <td>{{ item.email }}</td>
                        <td class="u-text-center acao"> 
                            <router-link :to="'/admin/usuario/edit/'+ item.id" class="link-icon" style="color: rgba(0, 0, 0, 0.87) !important;">
                                <el-button type="info" title="Editar" icon="el-icon-edit" size="mini"></el-button>
                            </router-link>
                            <el-button v-if="item.name != 'ADMINISTRADOR'" @click="deleteUsuario(item.id)" title="Excluir" type="danger" icon="el-icon-delete" size="mini"></el-button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr v-if="statusList && items.length == 0" style="border-top: 1px solid #ddd;">
                        <td colspan="100%" class="u-text-center">
                            <span>- nenhum registro -</span>
                        </td>
                    </tr>
                    <tr v-if="qtdItens > 10">
                        <td colspan="100%" class="u-text-right">
                            <el-pagination :total="qtdItens" @current-change="getPagePagination" :page-size="10" background layout="prev, pager, next" small></el-pagination>
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
            name: '',
            tipo: ''
        },
        page: 1,
        qtdItens: null,
        items: [ ]
    }),
    mounted () {
      this.loadingUsuarios()
    },
    methods: {
        loadingUsuarios(){

            this.statusList = false;
            this.items = [];

            this.$axios.post(`${this.$store.state.config.baseUrlApi}/api/usuario/getAllPaginate?page=` + this.page, this.filtro, this.$store.getters.getHeaderAuth).then(response => {

                this.items = response.data.data;
                this.qtdItens = response.data.total;
                this.statusList = true;

            }).catch((error) => { this.$store.commit('throwException', error); });

        },
        deleteUsuario(id){

            this.$msgbox.confirm('Tem certeza que deseja excluir esta usuario?', 'Atenção', { confirmButtonText: 'Sim', cancelButtonText: 'Não', type: 'warning' }).then(() => {

                window.eventBus.$emit('loading', true);
                    
                this.$axios.delete(`${this.$store.state.config.baseUrlApi}/api/usuario/delete/` + id, this.$store.getters.getHeaderAuth).then(response => {
                            
                    window.eventBus.$emit('loading', false);
                    window.eventBus.$emit('alert', {msg: 'Sucesso! - Operação realizada com Sucesso!', type: 'success'});
                    this.loadingUsuarios();

                }).catch((error) => { window.eventBus.$emit('loading', false); this.$store.commit('throwException', error); });

            }).catch(()=>{});

        },
        getPagePagination(page){
          this.page = page;
          this.loadingUsuarios();
        }
    }
}
</script>