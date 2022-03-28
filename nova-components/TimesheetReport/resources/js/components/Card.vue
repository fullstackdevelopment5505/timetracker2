<template>
    <card class="flex items-center">
        <div class="px-3 py-3">
            <!-- <h3>Daily Report</h3> -->
            <p class="mb-2 text-80">Click export button to export daily report to excel file.</p>
            <p class="mb-2 text-80">Manager can only export there user's daily report.</p>
            <!-- <input type="text" class="w-full form-control form-input form-input-bordered" v-model="filename"> -->
            <div class="flex items-center mt-3" v-if=" ! loading">
                <button @click="exportExcel()" class="btn btn-default btn-primary">Export</button>
            </div>
            <div class="mt-3" v-if="loading">
                <span class="font-bold dim text-80">exporting to excel file.</span>
            </div>
        </div>
    </card>
</template>

<script>
export default {
    props: [
        'card',
    ],
    data() {
        return {
            loading : false,
            email : null
        }
    },
    mounted() {
        console.log(this.card);
    },
    methods : {
        exportExcel() {
            this.loading = true;
            axios.get('/nova-vendor/' + this.card.component + '/export', {
                filename: this.filename
            }).then(response => {
                document.location.replace('/nova-vendor/' + this.card.component + '/export');
                this.loading = false;
                // const link = document.createElement('a');
                // link.setAttribute('href', response.data);
                // link.setAttribute('download', 'report.xlsx'); // Need to modify filename ...
                // link.click();
                // console.log(response.data);
            }).catch(error => {
                this.loading = false;
            });
        }
    },
}
</script>
