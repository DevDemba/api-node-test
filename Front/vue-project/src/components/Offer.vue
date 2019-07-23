<template>
    <div>
        <h1>Offer</h1>
        <div class="card">
            <b-card
            title="Card Title"
            img-src="https://picsum.photos/600/300/?image=25"
            img-alt="Image"
            img-top
            tag="article"
            style="max-width: 20rem;"
            class="mb-2">
            <b-card-text>
            Some quick example text to build on the card title and make up the bulk of the card's content.
            </b-card-text>
            <router-link :to="{ name:'Offer-detail' }"><b-button variant="primary">View-detail</b-button></router-link>
            </b-card>
        </div>
    </div>
</template>

<style scoped>
.card {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.error {
  color: red;
}
</style>
