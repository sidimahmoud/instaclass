<template>
    <div>
        <div class="row">
            <div class="col-md-6 font-weight-bold">
                <p>Société Instantavite</p>
                <p>32 avenue monseigneur déziel,</p>
                <p>Ville Québec, Quebec,</p>
                <p>G1E2T7</p>
                <P><a class="text-primary" href="https://instantaclass.ca">www.instantaclasse.ca</a></P>
                <p><a class="text-primary" href="tel:13121234562">Tel: 1-312-123-4562</a></p>
            </div>
            <div class="col-md-6 text-right">
                <h3 class="font-weight-bolder">RECEIPT</h3>
                <img src="../../assets/logo.png" width="150px" alt="Logo">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p class="font-weight-bold text-dark border-bottom">BILL TO</p>
                <p>Name</p>
                <p>Email</p>
                <p>Phone</p>
            </div>
            <div class="col-1"></div>
            <div class="col-md-5 text-right">
                <p class="font-weight-bold text-primary border-bottom">ORDER N° #1</p>
                <p>Payment Date: 25/10/2020</p>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">DESCRIPTION</th>
                <th scope="col">QTY</th>
                <th scope="col">UNIT PRICE($)</th>
                <th scope="col">TOTAL</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row" class="border-bottom">Math class</th>
                <td class="border-bottom">1</td>
                <td class="border-bottom">25.00</td>
                <td>25.00</td>
            </tr>
            <tr>
                <td class="border-0" colspan="2"/>
                <td class="text-right border-0">SUBTOTAL</td>
                <td>25.00</td>
            </tr>
            <tr>
                <td colspan="2" class="border-0"/>
                <td class="text-right border-0">TPS</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td colspan="2" class="border-0"/>
                <td class="text-right border-0">TVA</td>
                <td>0.00</td>
            </tr>
            <tr class="font-weight-bold">
                <td colspan="3" class="text-right border-0">Balance paid</td>
                <td> $25.00</td>
            </tr>
            </tbody>
        </table>
        <div class="text-center text-">Thank you for ordering with Instantavite!</div>
    </div>
</template>

<script>
    export default {
        name: "Receipt"
    }
</script>

<style scoped>

</style>
