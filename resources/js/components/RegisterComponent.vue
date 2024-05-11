<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-4">
                    <div class="card-header">Registration</div>

                    <div class="card-body">
                        <div v-if="errors_exist">
                            <div v-for="(error, index) in errors" :key="index" class="alert alert-danger alert-dismissible fade show border-0 mb-4" role="alert">
                                <span >{{ error[0] }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input v-model="form_data.first_name" type="text" class="form-control" id="firstName" placeholder="Enter First Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="middleName" class="form-label">Middle Name</label>
                                    <input v-model="form_data.middle_name" type="text" class="form-control" id="middleName" placeholder="Enter Middle Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                    <input v-model="form_data.last_name" type="text" class="form-control" id="lastName" placeholder="Enter Last Name">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="emailAddress" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input v-model="form_data.email_address" type="email" class="form-control" id="emailAddress" placeholder="Enter Email Address">
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><small>+63</small></span>
                                <input v-model="form_data.phone_number" type="number" class="form-control" id="phoneNumber" placeholder="Enter Phone Number">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Profile Image</label>
                            <input @change="getFile" class="form-control" type="file" id="formFile" accept="image/png, image/gif, image/jpeg">
                        </div>

                        <button @click="submitRequest" class="btn btn-primary mt-3 float-end">
                            <span v-if="loading" class="float-end">
                                Please wait..
                                <div class="spinner-border spinner-border-sm" role="status"></div>
                            </span>

                            <span v-else>
                                Submit
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form_data:{
                first_name: '',
                last_name: '',
                middle_name: '',
                email_address: '',
                phone_number: '',
                image: '',
            },
            errors: [],
            errors_exist : false,
            loading: false,
        }
    },
    methods: {
        submitRequest() {
            this.confirmMessage('Are you sure you want to <b>submit</b> the form?').then((result) => {
                if (result.isConfirmed) {
                    this.loading = true;
                    this.errors = [];
                    let formData = new FormData();

                    for (let key in this.form_data) {
                        if(this.form_data[key]) {
                            formData.append(key, this.form_data[key]);
                        }
                    }

                    axios.post('/register', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(response => {
                        this.loading = false;

                        this.alertMessage(response.data.status, response.data.message).then((result) => {
                            if(result.isConfirmed && response.data.status == 'success'){
                                this.clearFields();
                            }
                        });
                    })
                    .catch(errors => {
                        this.loading = false;
                        this.catchErrors(errors);
                    });
                }
            });
        },
        getFile(event) {
            this.form_data.image = event.target.files[0];
        },
        clearFields() {
            for (let key in this.form_data) {
                this.form_data[key] = '';
            }
        }
    }
}
</script>
