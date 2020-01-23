<template>
    
    <div class="main">
        <c-panel>
            <form-estado :paramId="$route.params.id" v-on:onSubmitEstado="onSubmitEstado"></form-estado>
        </c-panel>
    </div>
    
</template>
<script>

import formEstado from "./form"

export default {
    methods:{

        onSubmitEstado(){

            this.$router.push('/admin/endereco/2'); 
        }
    },
    components:{ formEstado }
}
</script>
