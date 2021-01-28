<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="container mx-auto mt-10">
                        <div class="flex shadow-md my-10">
                            <div class="w-3/4 bg-white px-10 py-10">
                                <div class="flex justify-between border-b pb-8">
                                    <h1 class="font-semibold text-2xl">Shopping Cart</h1>
                                    <h2 class="font-semibold text-2xl">{{cartCount}} Items</h2>
                                </div>
                                <div class="flex mt-10 mb-5">
                                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
                                </div>
                                <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5" v-for="row in cartContent"
                                     :key="row.rowId">
                                    <div class="flex w-2/5"> <!-- product -->
                                        <div class="w-20">
                                            <img class="h-24" src="https://drive.google.com/uc?id=18KkAVkGFvaGNqPy2DIvTqmUH_nk39o3z" alt="">
                                        </div>
                                        <div class="flex flex-col justify-between ml-4 flex-grow">
                                            <span class="font-bold text-sm">{{row.name}}</span>
                                            <a class="text-red-500 text-xs" @click="saveForLater(row.rowId)">Save for later</a>
                                            <a @click="removeAllItem(row.rowId)" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</a>
                                        </div>
                                    </div>
                                    <div class="flex justify-center w-1/5 ">
                                        <svg @click="removeItem(row.rowId)" class="fill-current text-gray-600 hover:text-black w-3" viewBox="0 0 448 512"><path d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                                        </svg>

                                        <p class="mx-2 border text-center w-8" type="text" >{{row.qty}}</p>
                                        <svg @click="addItem(row.id)" class="fill-current text-gray-600 hover:text-black w-3" viewBox="0 0 448 512">
                                            <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                                        </svg>
                                    </div>
                                    <span class="text-center w-1/5 font-semibold text-sm">{{formatCurrency(row.price)}}</span>
                                    <span class="text-center w-1/5 font-semibold text-sm">{{formatCurrency(totalPrice(row.price, row.qty))}}</span>
                                </div>

                                    <jet-nav-link :href="route('products.index')" :active="route().current('products.index')"  class="flex font-semibold text-indigo-600 text-sm mt-10">
                                        <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512"><path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/></svg>
                                        Continue Shopping
                                    </jet-nav-link>
                                <div class="flex justify-between border-b pb-8 mt-8">
                                    <h2 class="font-semibold text-2xl">Items saved for later</h2>
                                    <h3 class="font-semibold text-2xl">{{cartCount}} Items</h3>
                                </div>
                                <div v-for="row in cartLater" :key="row.rowId">
                                    <div class="flex flex-row mt-8" >
                                        <div class="flex w-1/3 flex-row"> <!-- product -->
                                            <div class="w-20">
                                                <img class="h-24" src="https://drive.google.com/uc?id=18KkAVkGFvaGNqPy2DIvTqmUH_nk39o3z" alt="">
                                            </div>
                                            <div class="flex flex-col justify-between ml-4 flex-grow">
                                                <span class="font-bold text-sm">{{row.name}}</span>
                                                <span class="text-red-500 text-xs">Apple</span>
                                                <a @click="removeAllItem(row.rowId)" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</a>
                                            </div>
                                        </div>
                                </div>

                                </div>



                            </div>

                            <div id="summary" class="w-1/4 px-8 py-10">
                                <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
                                <div class="flex justify-between mt-10 mb-5">
                                    <span class="font-semibold text-sm uppercase">Items {{cartCount}}</span>
                                    <span class="font-semibold text-sm">${{cartTotal}}</span>
                                </div>
                                <div>
                                    <label class="font-medium inline-block mb-3 text-sm uppercase">Shipping</label>
                                    <select class="block p-2 text-gray-600 w-full text-sm">
                                        <option>Standard shipping - $10.00</option>
                                    </select>
                                </div>
                                <div class="py-10">
                                    <label for="promo" class="font-semibold inline-block mb-3 text-sm uppercase">Promo Code</label>
                                    <input type="text" id="promo" placeholder="Enter your code" class="p-2 text-sm w-full">
                                </div>
                                <button class="bg-red-500 hover:bg-red-600 px-5 py-2 text-sm text-white uppercase">Apply</button>
                                <div class="border-t mt-8">
                                    <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                                        <span>Total cost</span>
                                        <span>${{cartTotal}}</span>
                                    </div>
                                    <button class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Checkout</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </app-layout>

</template>
<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetNavLink from '@/Jetstream/NavLink'

    export default {
        props:{
            // cart: Object,
            cartCount:Number,
            cartContent:Object,
            cartTotal:String,
            cartLater: Object
        },
        components: {
            JetNavLink,
            AppLayout,
        },
        methods: {
            saveForLater(id){
                this.$inertia.post(`/cart/savelater/${id}`,{
                    onBefore: () => confirm('Are you sure you want to save item for later?'),
                })
                    .then(()=>{
//
                    })
            },
            totalPrice(price, qty){
                return price*qty;
            },
            addItem(id){
                this.$inertia.post(`/cart/${id}`,{
                    onBefore: () => confirm('Are you sure you want to add item?'),
                })
                    .then(()=>{
//
                    })
            },
            removeItem(id){
                this.$inertia.post(`/cart/remove/${id}`,{
                    onBefore: () => confirm('Are you sure you want to remove item?'),
                })
                    .then(()=>{
//
                    })
            },
            removeAllItem(id){
                this.$inertia.post(`/cart/removeall/${id}`,{
                    onBefore: () => confirm('Are you sure you want to remove item?'),
                })
                    .then(()=>{
//
                    })
            },
            formatCurrency(amount) {
                amount = ( amount / 100);
                return amount.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
            }
        },
    }
</script>
