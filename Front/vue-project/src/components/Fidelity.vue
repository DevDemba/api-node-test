<template>
    <div class="container fluid">
        <h1>Fidelity</h1>
        <h4>Best customers</h4>

        <div class="container card">
            
            <table class="cart_table">
                <tr class="table title">
                    <th v-for="column in columns" :key="column.index">{{column}}</th>
                    <th> </th>
                </tr>
                <tr class="table_value">
                    <td>1</td>
                    <td>test</td>
                    <td>15</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: 'fidelity',
    data(){
        return {
            columns: ['id', 'user', 'point']
        }
    }
    
}
</script>

<style scoped>
table th, td{
    text-align: center;
}
</style>

