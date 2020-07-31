<template>
    <div>
        <div class="card-header text-center pt-4">
            <h4>{{ tab_name }} Balance</h4>
            <h1 id="balance">{{ totalIncome(tab)-totalExpense(tab) }} ₹</h1>
        </div>
        <div class="card-body">
            <div class="text-center">
                <div class="inc-exp-container">
                    <div>
                        <h4>Income</h4>
                        <p id="money-plus" class="money plus">+{{ totalIncome(tab) }} ₹</p>
                    </div>
                    <div>
                        <h4>Expense</h4>
                        <p id="money-minus" class="money minus">-{{ totalExpense(tab) }} ₹</p>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <ul
                    class="nav nav-pills nav-fill justify-content-center tab-text"
                    id="myTab"
                    role="tablist"
                >
                    <li class="nav-item" role="presentation">
                        <a
                            class="nav-link active"
                            :id="tab_name+'-history-tab'"
                            data-toggle="tab"
                            :href="'#'+tab_name+'-history'"
                            role="tab"
                            :aria-controls="tab_name+'-histroy'"
                            aria-selected="true"
                        >History</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a
                            class="nav-link"
                            :id="tab_name+'-income-tab'"
                            data-toggle="tab"
                            :href="'#'+tab_name+'-income'"
                            role="tab"
                            :aria-controls="tab_name+'-income'"
                            aria-selected="false"
                        >Add Income</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a
                            class="nav-link"
                            :id="tab_name+'-expense-tab'"
                            data-toggle="tab"
                            :href="'#'+tab_name+'-expense'"
                            role="tab"
                            :aria-controls="tab_name+'-expense'"
                            aria-selected="false"
                        >Add Expense</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="myTabContent">
                    <div
                        class="tab-pane fade show active"
                        :id="tab_name+'-history'"
                        role="tabpanel"
                        :aria-labelledby="tab_name+'-history-tab'"
                    >
                        <h3>History</h3>
                        <ul
                            id="list"
                            class="list-group"
                            v-for="(item, index) in items"
                            :key="index"
                        >
                            <item
                                class="list-group-item"
                                v-if="item.tab_id == tab.id"
                                :item_id="item.id"
                                :item_name="item.item_name"
                                :item_amount="item.item_amount"
                                :item_is_income="item.item_is_income"
                                :tab_id="item.tab_id"
                                @on-fetch-items="fetchItems()"
                                @on-delete="deteleItem(item)"
                            />
                        </ul>
                        <hr />
                    </div>

                    <div
                        class="tab-pane fade"
                        :id="tab_name+'-income'"
                        role="tabpanel"
                        :aria-labelledby="tab_name+'-income-tab'"
                    >
                        <h3>Add Income</h3>
                        <form @submit.prevent="addIncomeItem(tab)">
                            <div class="form-group">
                                <label for="item" class="float-left">Item</label>
                                <input
                                    v-model="item.item_name"
                                    type="text"
                                    class="form-control"
                                    id="item"
                                    placeholder="Enter item..."
                                />
                            </div>
                            <div class="form-group">
                                <label for="amount" class="float-left">Amount</label>
                                <input
                                    v-model="item.item_amount"
                                    type="number"
                                    class="form-control"
                                    id="amount"
                                    placeholder="Enter amount..."
                                />
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Add Income</button>
                        </form>
                        <hr class="marg" />
                    </div>
                    <div
                        class="tab-pane fade"
                        :id="tab_name+'-expense'"
                        role="tabpanel"
                        :aria-labelledby="tab_name+'-expense-tab'"
                    >
                        <h3>Add Expense</h3>
                        <form @submit.prevent="addExpenseItem(tab)">
                            <div class="form-group">
                                <label for="item" class="float-left">Item</label>
                                <input
                                    v-model="item.item_name"
                                    type="text"
                                    class="form-control"
                                    id="item"
                                    placeholder="Enter item..."
                                />
                            </div>
                            <div class="form-group">
                                <label for="amount" class="float-left">Amount</label>
                                <input
                                    v-model="item.item_amount"
                                    type="number"
                                    class="form-control"
                                    id="amount"
                                    placeholder="Enter amount..."
                                />
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Add Expense</button>
                        </form>
                        <div class="marg">
                            <hr />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
Vue.prototype.$user_id = document
    .querySelector("meta[name='user-id']")
    .getAttribute("content");

export default {
    props: {
        tab: Object,
        tab_name: String,
    },
    data() {
        return {
            items: [],
            item: {
                id: "",
                item_name: "",
                item_amount: "",
                item_is_income: "",
            },
            item_id: "",
        };
    },
    created() {
        this.fetchItems();
    },
    methods: {
        fetchItems() {
            fetch("api/items/" + this.$user_id)
                .then((res) => res.json())
                .then((res) => {
                    this.items = res.data;
                });
        },
        addIncomeItem(tab) {
            this.item.item_is_income = "1";
            fetch("api/item/" + tab.id + "/" + this.$user_id, {
                method: "post",
                body: JSON.stringify(this.item),
                headers: {
                    "Content-Type": "application/json",
                },
            })
                .then((res) => res.json())
                .then((data) => {
                    this.item.item_name = "";
                    this.item.item_amount = "";
                    this.item.item_is_income = "";
                    this.fetchItems();
                })
                .catch((error) => console.log(error));
        },
        addExpenseItem(tab) {
            this.item.item_is_income = "0";
            fetch("api/item/" + tab.id + "/" + this.$user_id, {
                method: "post",
                body: JSON.stringify(this.item),
                headers: {
                    "Content-Type": "application/json",
                },
            })
                .then((res) => res.json())
                .then((data) => {
                    this.item.item_name = "";
                    this.item.item_amount = "";
                    this.item.item_is_income = "";
                    this.fetchItems();
                })
                .catch((error) => console.log(error));
        },
        deteleItem(item) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.value) {
                    fetch(
                        "api/item/" +
                            item.id +
                            "/" +
                            item.tab_id +
                            "/" +
                            this.$user_id,
                        {
                            method: "delete",
                        }
                    )
                        .then((res) => res.json())
                        .then((data) => {
                            this.fetchItems();
                        })
                        .catch((error) => console.log(error));
                    Swal.fire("Deleted!", "Item has been deleted.", "success");
                }
            });
        },

        totalIncome(tab) {
            let income = 0;
            for (let i = 0; i < this.items.length; i++) {
                if (this.items[i].tab_id == tab.id) {
                    if (this.items[i].item_is_income) {
                        income += parseFloat(this.items[i].item_amount);
                    }
                }
            }

            return income;
        },
        totalExpense(tab) {
            let expense = 0;
            for (let i = 0; i < this.items.length; i++) {
                if (this.items[i].tab_id == tab.id) {
                    if (!this.items[i].item_is_income) {
                        expense += parseFloat(this.items[i].item_amount);
                    }
                }
            }

            return expense;
        },
    },
};
</script>
