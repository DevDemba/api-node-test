    <template>
    <div class="register">
        <h4>Register Vehicle</h4>
        <form>
        <input type="file" id="image" ref="image" v-on:change="handleFileUpload()" />
        <b-form-input type="text" v-model="marque" placeholder="Marque" required />
        <b-form-input type="text" v-model="serial_number" placeholder="Serial Number" required />
        <b-form-input type="color" v-model="color" placeholder="Color" required />
        <b-form-input type="text" v-model="nb_plate" placeholder="Number Plate" required />
        <b-form-input type="text" v-model="nb_kilometer" placeholder="Number of kilometer" required />
        <b-form-input type="date" v-model="purchase_date" placeholder="Purchase date " required />
        <b-form-input type="price" v-model="price" placeholder="Price" required />

        <b-button type="submit" @click="handleSubmit">Add Vehicle</b-button>
        </form>
    </div>
    </template>

        <script>
    import axios from "axios";
    import router from "../router";

    export default {
    name: "RegisterVehicle",
    props: ["nextUrl"],
    data() {
        return {
        image: "",
        marque: "",
        serial_number: "",
        color: "",
        nb_plate: "",
        nb_kilometer: "",
        purchase_date: "",
        price: ""
        };
    },
    methods: {
        handleSubmit(e) {
        e.preventDefault();

        let url = "http://localhost:3000/api/vehicle";

        let vehicle = {
            image: this.image,
            marque: this.marque,
            serial_number: this.serial_number,
            color: this.color,
            nb_plate: this.nb_plate,
            nb_kilometer: this.nb_kilometer,
            purchase_date: this.purchase_date,
            price: this.price
        };

        axios
            .post(url, vehicle)
            .then(response => {
            localStorage.setItem(
                "vehicle",
                JSON.stringify(response.data.vehicle)
            );
            localStorage.setItem("jwt", response.data.token);
            console.log(response.data.vehicle);
            if (localStorage.getItem("jwt") != null) {
                alert("Add vehicle");
                this.$router.push("/offer");
            }
            })
            .catch(error => {
            console.error(error);
            });
        },

        handleFileUpload() {
        this.image = this.$refs.image.files[0];
        }
    }
    };
    </script>

<style scoped>
.register {
  width: 500px;
  border: 1px solid #cccccc;
  background-color: #ffffff;
  margin: auto;
  margin-top: 30px;
  padding: 10px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
