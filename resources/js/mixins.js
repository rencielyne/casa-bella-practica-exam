export default {
    methods: {

        /**
        * Confirm message.
        * @param text
        */
        confirmMessage(text) {
            return this.$swal.fire({
                html: "<h5 class='confirm-custom-title'>" + text + "</h5>",
                icon: 'question',
                showDenyButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
                allowOutsideClick: false,
            })
        },

        /**
        * Alert message.
        * @param type
        * @param text
        */
        alertMessage(type, text) {
            return this.$swal.fire({
                html: "<h5 class='confirm-custom-title'>" + text + "</h5>",
                customClass: 'swal-small',
                confirmButtonText: `OK`,
                icon: type,
                allowOutsideClick: false,
            })
        },
        
        /**
        * Catch error.
        * @param errors
        */
        catchErrors(errors) {
            this.errors = [];
            this.errors_exist = false;

            if (errors.response.status === 422) {
                let key = Object.keys(errors.response.data.errors)[0];
                let error_message = errors.response.data.errors[key][0];

                this.errors_exist = true;
                this.errors = errors.response.data.errors || {};
                return this.alertMessage('error', error_message);
            }
            else if (errors.response.status === 413) {
                return this.alertMessage('error', 'Request File Too Large');
            }
            else {
                return this.alertMessage('error', errors.response.data.message);
            }
        },
    }
};
