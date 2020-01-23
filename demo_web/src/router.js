import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import Login from '@/autentication/login'

/* LAYOUT */
const Layout = () => import('@/layout')

/* HOME */
const Home = () => import('@/components/home')

 
/*** USUÁRIO ***/
const ListUsuario = () => import('@/components/usuario/list')
const FormUsuario = () => import('@/components/usuario/form')

/*** MODELO ***/
const ListModelo = () => import('@/components/modelo/list')
const FormModelo = () => import('@/components/modelo/form')

/* TELAS DE ERROR */
const ErroAuth = () => import('@/shared/error/erro-auth')
const Erro500 = () => import('@/shared/error/erro-500')

/* TELA DE ENDEREÇO */
const Endereco = () => import('@/components/endereco')

/*** ESTADO ***/
const ListEstado = () => import('@/components/estado/list')
const FormEstado = () => import('@/components/estado/form')

/*** CIDADE ***/
const ListCidade = () => import('@/components/cidade/list')
const FormCidade = () => import('@/components/cidade/form')

/*** LOGRADOURO ***/
const ListLogradouro = () => import('@/components/logradouro/list')
const FormLogradouro = () => import('@/components/logradouro/form')

/*** BAIRRO ***/
const ListBairro = () => import('@/components/bairro/list')
const FormBairro = () => import('@/components/bairro/form')

/*** CEP ***/
const ListCep = () => import('@/components/cep/list')
const FormCep = () => import('@/components/cep/form')

/*** INSTITUIÇÃO ***/
const ListInstituicao = () => import('@/components/instituicao/list')
const FormInstituicao = () => import('@/components/instituicao/form')


const router = new Router({
  mode: 'history',
  base: '/painel',  
  routes: [
    
      { path: '/', redirect: '/admin' },
      { path: '/login', component: Login },
      { path: '/erro-auth', component: ErroAuth },
      { path: '/admin', component: Layout,
        children: [
          { path: '/', component: Home, meta: { auth: true, title: "Página Inicial" } },
          
          { path: 'instituicao', component: ListInstituicao, meta: { requiresAuth: true, title: "Listagem de Instituições", breadcrumb: [{txt: 'Página Inicial', url: '/'}, {txt: 'listagem de instituicões', url: false}] } },
          { path: 'instituicao/cadastro', component: FormInstituicao, meta: { requiresAuth: true, title: "Nova Instituicao", breadcrumb: [{txt: 'Página Inicial', url: '/'}, {txt: 'instituicões', url: '../instituicao'}, {txt: 'nova instituicao', url: false}] } },
          { path: 'instituicao/edit/:id', component: FormInstituicao, meta: { requiresAuth: true, title: "Editar Instituicao", breadcrumb: [{txt: 'Página Inicial', url: '/'}, {txt: 'instituicões', url: '../../instituicao'}, {txt: 'editar instituicao', url: false}] } },

          { path: 'usuario', component: ListUsuario, meta: { requiresAuth: true, title: "Listagem de Usuarios", breadcrumb: [{txt: 'Página Inicial', url: '/'}, {txt: 'listagem de usuarios', url: false}] } },
          { path: 'usuario/cadastro', component: FormUsuario, meta: { requiresAuth: true, title: "Novo Usuario", breadcrumb: [{txt: 'Página Inicial', url: '/'}, {txt: 'usuarios', url: '../usuario'}, {txt: 'novo usuario', url: false}] } },
          { path: 'usuario/edit/:id', component: FormUsuario, meta: { requiresAuth: true, title: "Editar Usuario", breadcrumb: [{txt: 'Página Inicial', url: '/'}, {txt: 'usuarios', url: '../../usuario'}, {txt: 'editar usuario', url: false}] } },
          
          { path: 'modelo', component: ListModelo, meta: { requiresAuth: true, title: "Listagem de Modelos", breadcrumb: [{txt: 'Página Inicial', url: '/'}, {txt: 'listagem de modelos', url: false}] } },
          { path: 'modelo/cadastro', component: FormModelo, meta: { requiresAuth: true, title: "Novo Modelo", breadcrumb: [{txt: 'Página Inicial', url: '/'}, {txt: 'modelos', url: '../modelo'}, {txt: 'novo modelo', url: false}] } },
          { path: 'modelo/edit/:id', component: FormModelo, meta: { requiresAuth: true, title: "Editar Modelo", breadcrumb: [{txt: 'Página Inicial', url: '/'}, {txt: 'modelos', url: '../../modelo'}, {txt: 'editar modelo', url: false}] } },

          { path: 'endereco/:tab?', component: Endereco, meta: { requiresAuth: true, title: "Endereço", breadcrumb: [{txt: 'Página Inicial', url: '/'}, {txt: 'endereço', url: false}] } },

          { path: 'estado', component: ListEstado, meta: { requiresAuth: true, title: "Listagem de Estados", breadcrumb: [{txt: 'Página Inicial', url: '/'}, {txt: 'listagem de estados', url: false}] } },
          { path: 'estado/cadastro', component: FormEstado, meta: { requiresAuth: true, title: "Novo Estado", breadcrumb: [{ txt: 'Página Inicial', url: '/' }, { txt: 'estados', url: '/admin/endereco/3'}, {txt: 'novo estado', url: false}] } },
          { path: 'estado/edit/:id', component: FormEstado, meta: { requiresAuth: true, title: "Editar Estado", breadcrumb: [{ txt: 'Página Inicial', url: '/' }, { txt: 'estados', url: '/admin/endereco/3'}, {txt: 'editar estado', url: false}] } },

          { path: 'cidade', component: ListCidade, meta: { requiresAuth: true, title: "Listagem de Cidades", breadcrumb: [{txt: 'Página Inicial', url: '/'}, {txt: 'listagem de cidades', url: false}] } },
          { path: 'cidade/cadastro', component: FormCidade, meta: { requiresAuth: true, title: "Novo Cidade", breadcrumb: [{ txt: 'Página Inicial', url: '/' }, { txt: 'cidades', url: '/admin/endereco/4'}, {txt: 'nova cidade', url: false}] } },
          { path: 'cidade/edit/:id', component: FormCidade, meta: { requiresAuth: true, title: "Editar Cidade", breadcrumb: [{ txt: 'Página Inicial', url: '/' }, { txt: 'cidades', url: '/admin/endereco/4'}, {txt: 'editar cidade', url: false}] } },

          { path: 'logradouro', component: ListLogradouro, meta: { requiresAuth: true, title: "Listagem de Logradouros", breadcrumb: [{txt: 'Página Inicial', url: '/'}, {txt: 'listagem de logradouros', url: false}] } },
          { path: 'logradouro/cadastro', component: FormLogradouro, meta: { requiresAuth: true, title: "Novo Logradouro", breadcrumb: [{ txt: 'Página Inicial', url: '/' }, { txt: 'logradouros', url: '/admin/endereco/1'}, {txt: 'novo logradouro', url: false}] } },
          { path: 'logradouro/edit/:id', component: FormLogradouro, meta: { requiresAuth: true, title: "Editar Logradouro", breadcrumb: [{ txt: 'Página Inicial', url: '/' }, { txt: 'logradouros', url: '/admin/endereco/1'}, {txt: 'editar logradouro', url: false}] } },

          { path: 'bairro', component: ListBairro, meta: { requiresAuth: true, title: "Listagem de Bairros", breadcrumb: [{txt: 'Página Inicial', url: '/'}, {txt: 'listagem de bairros', url: false}] } },
          { path: 'bairro/cadastro', component: FormBairro, meta: { requiresAuth: true, title: "Novo Bairro", breadcrumb: [{ txt: 'Página Inicial', url: '/' }, { txt: 'bairros', url: '/admin/endereco/2'}, {txt: 'novo bairro', url: false}] } },
          { path: 'bairro/edit/:id', component: FormBairro, meta: { requiresAuth: true, title: "Editar Bairro", breadcrumb: [{ txt: 'Página Inicial', url: '/' }, { txt: 'bairros', url: '/admin/endereco/2'}, {txt: 'editar bairro', url: false}] } },

          { path: 'cep', component: ListCep, meta: { requiresAuth: true, title: "Listagem de Ceps", breadcrumb: [{txt: 'Página Inicial', url: '/'}, {txt: 'listagem de ceps', url: false}] } },
          { path: 'cep/cadastro', component: FormCep, meta: { requiresAuth: true, title: "Novo Cep", breadcrumb: [{ txt: 'Página Inicial', url: '/' }, { txt: 'ceps', url: '/admin/endereco/0'}, {txt: 'novo cep', url: false}] } },
          { path: 'cep/edit/:id', component: FormCep, meta: { requiresAuth: true, title: "Editar Cep", breadcrumb: [{ txt: 'Página Inicial', url: '/' }, { txt: 'ceps', url: '/admin/endereco/0'}, {txt: 'editar cep', url: false}] } },

          { path: '/erro-500', component: Erro500 },
        ],
      }      
  ]
})

router.beforeEach((to, from, next) => {

  if (to.matched.some(record => record.meta.auth)) {
     
    if(!sessionStorage.getItem("sis3569Token")){
      
      next({ path: '/login' });
      return false;
    
    }
    
  }

  next();

})


export default router