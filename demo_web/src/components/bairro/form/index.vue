<template>
    
    <div class="main">
        <c-panel>
            <form-bairro :paramId="$route.params.id" v-on:onSubmitBairro="onSubmitBairro"></form-bairro>
        </c-panel>
    </div>
    
</template>
<script>

import formBairro from "./form"

export default {
    methods:{

        onSubmitBairro(){

            this.$router.push('/admin/endereco/1'); 
        }
    },
    components:{ formBairro }
}
</script>
