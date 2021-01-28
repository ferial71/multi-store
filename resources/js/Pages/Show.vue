<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>
        <!--        <h1>{{products.data}}</h1>-->

        <div class="container mx-auto px-6 mt-8">
            <section class="text-gray-700 body-font overflow-hidden" v-if="product">
                <div class="container px-12 py-24 mx-auto">
                    <div class="lg:w-3/5 mx-auto flex flex-wrap">
                        <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="https://images.unsplash.com/photo-1563170351-be82bc888aa4?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=376&amp;q=80">
                        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                            <h2
                                class="text-sm title-font text-gray-500 tracking-widest uppercase inline-block mr-2"
                                v-for="category in product.categories"
                                v-text="category.name"
                            ></h2>
                            <h1
                                class="text-gray-900 text-3xl title-font font-medium mb-2"
                                v-text="product.name"
                            ></h1>
                            <p
                                class="leading-relaxed"
                                v-text="product.description"
                            ></p>
                            <div class="flex mt-6 pt-4 border-t-2 border-gray-200">
                        <span
                            class="title-font font-medium text-2xl text-gray-900"
                            v-text="formatCurrency(product.price)"
                        ></span>
                                <button
                                    class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded"
                                    @click="addItem( product.id)"
                                >Add To Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!--        <div class="py-12">-->
        <!--            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">-->
        <!--                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">-->
        <!--                    <Item/>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->

        <Footer/>


    </app-layout>

</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import Item from "@/components/Item";
    import Footer from "@/components/Footer";
    import Cart from "@/Pages/Cart";
    import JetNavLink from '@/Jetstream/NavLink'
    export default {
        components: {
            JetNavLink,
            Cart,
            Footer,
            Item,
            AppLayout,
            Welcome,
        },
        props: {
            product: Object,
        },
        methods: {
            addItem(id){
                this.$inertia.post(`/cart/${id}`,{
                    onBefore: () => confirm('Are you sure you want to add item?'),
                })
                    .then(()=>{
//
                    })
            },
            formatCurrency(amount) {
                amount = (amount / 100);
                return amount.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
            }
        },
    }
</script>

