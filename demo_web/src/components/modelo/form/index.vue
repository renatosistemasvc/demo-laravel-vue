<template>
    
    <div class="main">
        <c-panel>
            <form-modelo :paramId="$route.params.id" v-on:onSubmitModelo="onSubmitModelo"></form-modelo>
        </c-panel>
    </div>
    
</template>
<script>

import formModelo from "./form"

export default {
    methods:{

        onSubmitModelo(){

            this.$router.push('/admin/modelo');  
        }
    },
    components:{ formModelo }
}
</script>
