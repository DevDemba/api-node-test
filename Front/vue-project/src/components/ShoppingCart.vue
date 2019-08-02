<template>
    <div class="container fluid"> 
        <h1>Shopping Cart</h1>
        
        <ul>
            <li v-for="vehicle in vehicles" :key="vehicle.id">
                {{ vehicle.title }} - {{ vehicle.price}} - {{ vehicle.available }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    computed: {
        vehicles() {
           
        }
    }
    
}
</script>

<style scoped>

</style>
