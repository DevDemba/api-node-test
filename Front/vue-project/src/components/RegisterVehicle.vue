    <template>
    <div class="register">
        <h1>Register Vehicle</h1>
        <b-form-group>
            <div>
                <b-img thumbnail fluid v-bind:src="previewImage" v-show="showPreview" class="uploading-image"></b-img>
                <input id="image" type="file" ref="image" accept="image/*" @change="uploadImage" />
             <!--    <b-button v-on:click="uploadImage()">save</b-button> -->
            </div>
            <div>
                <b-form-select v-model="type_vehicle" :options="options" required></b-form-select>
            </div>
            <b-form-input type="text" v-model="marque" placeholder="Marque" required />
            <b-form-input type="text" v-model="serial_number" placeholder="Serial Number" required />
            <b-form-input type="color" v-model="color" placeholder="Color" required />
            <b-form-input type="text" v-model="nb_plate" placeholder="Number Plate" required />
            <b-form-input type="text" v-model="nb_kilometer" placeholder="Number of kilometer" required />
            <b-form-input type="date" v-model="purchase_date" placeholder="Purchase date " required />
            <b-form-input type="price" v-model="price" placeholder="Price" required />
            <b-button type="submit" @click="handleSubmit">Add Vehicle</b-button>
        </b-form-group>
    </div>
    </template>

    <script>
    import axios from "axios";
    import router from "../router";

    export default {
    name: "RegisterVehicle",
    props: ["nextUrl"],
/*     props: {
       image: {
        type: String,
         default: () => {
           return '';
         }
       }
    }, */
    data() {
        return {
        type_vehicle: null,
        options: [
            { value: null, text: 'Please select an option' },
            { value: 1, text: 'This is a car' },
            { value: 2, text: 'This is a moto' },
        ],
        image: '',
        showPreview: false,
        previewImage: null,
        marque: '',
        serial_number: '',
        color: '',
        nb_plate: '',
        nb_kilometer: '',
        purchase_date: '',
        price: '',
        };
    },
    methods: {
        handleSubmit(e) {
        e.preventDefault();

        let url = "/api/vehicle";

        let vehicle = {
            type_vehicle: this.type_vehicle,
            image: this.$refs.image.files[0].name,
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
            localStorage.setItem('vehicle', JSON.stringify(response.data.vehicle));
            //console.log(response.data.vehicle);
                if (localStorage.getItem("token") != null) {
                    this.$swal({
                        position: 'center',
                        type: 'success',
                        title: 'Add vehicle in databse',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    this.$router.push("/offer");
                }
            })
            .catch(error => {
            console.error(error);
            });
        },
        uploadImage(e) {
            const image = this.$refs.image.files[0];
             if (!image) {
                console.error("no file selected");
                return;
            }

            const reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e =>{
                this.showPreview = true;
                this.previewImage = e.target.result;
                //console.log(this.previewmage);
            };
            
            let formData = new FormData();

            formData.append('image', image);

            return axios.post(
                `/api/upload`,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            )
            .then(response => {
                console.info("file uploaded successfully");
            })
            .catch(error => {
                console.error("file upload failed", error);
            }); 
         
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
.uploading-image{
     display:flex;
     justify-content: center;
     align-items: center;
     width: 280px;
     height: 280px;
     min-width: 280px;
     min-height: 280px;
   }
</style>
