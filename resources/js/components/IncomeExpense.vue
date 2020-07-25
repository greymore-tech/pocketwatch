<template>
    <div>
        <div class="card-header text-center">
            <h4>Your Balance</h4>
            <h1 id="balance">{{ totalIncome-totalExpense }} ₹</h1>
        </div>
        <div class="card-body">
            <div class="text-center">
                <div class="inc-exp-container">
                    <div>
                        <h4>Income</h4>
                        <p id="money-plus" class="money plus">+{{totalIncome }} ₹</p>
                    </div>
                    <div>
                        <h4>Expense</h4>
                        <p id="money-minus" class="money minus">-{{ totalExpense }} ₹</p>
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
                            id="history-tab"
                            data-toggle="tab"
                            href="#history"
                            role="tab"
                            aria-controls="histroy"
                            aria-selected="true"
                        >History</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a
                            class="nav-link"
                            id="income-tab"
                            data-toggle="tab"
                            href="#income"
                            role="tab"
                            aria-controls="income"
                            aria-selected="false"
                        >Add Income</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a
                            class="nav-link"
                            id="expense-tab"
                            data-toggle="tab"
                            href="#expense"
                            role="tab"
                            aria-controls="expense"
                            aria-selected="false"
                        >Add Expense</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="myTabContent">
                    <div
                        class="tab-pane fade show active"
                        id="history"
                        role="tabpanel"
                        aria-labelledby="history-tab"
                    >
                        <h3>History</h3>
                        <ul id="list" class="list-group">
                            <item
                                class="list-group-item"
                                v-for="(item, index) in items"
                                :key="index"
                                :itemName="item.itemName"
                                :itemAmount="item.itemAmount"
                                :income="item.income"
                                @on-delete="deteleItem(item)"
                                @on-edit-name="editItemName(item, $event)"
                                @on-edit-amount="editItemAmount(item, $event)"
                            />
                        </ul>
                    </div>

                    <div
                        class="tab-pane fade"
                        id="income"
                        role="tabpanel"
                        aria-labelledby="income-tab"
                    >
                        <h3>Add Income</h3>
                        <form @submit.prevent>
                            <div class="form-group">
                                <label for="item" class="float-left">Item</label>
                                <input
                                    v-model="newItemName"
                                    type="text"
                                    class="form-control"
                                    id="item"
                                    placeholder="Enter item..."
                                />
                            </div>
                            <div class="form-group">
                                <label for="amount" class="float-left">Amount</label>
                                <input
                                    v-model="newItemAmount"
                                    type="number"
                                    class="form-control"
                                    id="amount"
                                    placeholder="Enter amount..."
                                />
                            </div>
                            <button
                                @click="pushIncomeItem()"
                                class="btn btn-primary btn-block"
                            >Add Income</button>
                        </form>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="expense"
                        role="tabpanel"
                        aria-labelledby="expense-tab"
                    >
                        <h3>Add Expense</h3>
                        <form @submit.prevent>
                            <div class="form-group">
                                <label for="item" class="float-left">Item</label>
                                <input
                                    v-model="newItemName"
                                    type="text"
                                    class="form-control"
                                    id="item"
                                    placeholder="Enter item..."
                                />
                            </div>
                            <div class="form-group">
                                <label for="amount" class="float-left">Amount</label>
                                <input
                                    v-model="newItemAmount"
                                    type="number"
                                    class="form-control"
                                    id="amount"
                                    placeholder="Enter amount..."
                                />
                            </div>
                            <button
                                @click="pushExpenseItem()"
                                class="btn btn-primary btn-block"
                            >Add Expense</button>
                        </form>
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
            items: [
                { itemName: "Item 1", itemAmount: "100", income: true },
                { itemName: "Item 2", itemAmount: "200", income: false },
                { itemName: "Item 3", itemAmount: "300", income: true },
            ],
            newItemName: "",
            newItemAmount: "",
            income: "",
            switch1: true,
        };
    },
    methods: {
        pushIncomeItem() {
            if (this.newItemName.length > 1) {
                this.items.push({
                    itemName: this.newItemName,
                    itemAmount: this.newItemAmount,
                    income: true,
                });
            }
            this.newItemName = "";
            this.newItemAmount = "";
        },
        pushExpenseItem() {
            if (this.newItemName.length > 1) {
                this.items.push({
                    itemName: this.newItemName,
                    itemAmount: this.newItemAmount,
                    income: false,
                });
            }
            this.newItemName = "";
            this.newItemAmount = "";
        },
        editItemName(item, newItemName) {
            item.itemName = newItemName;
        },
        editItemAmount(item, newItemAmount) {
            item.itemAmount = newItemAmount;
        },
        deteleItem(deleteItem) {
            this.items = this.items.filter((item) => item !== deleteItem);
        },
    },
    computed: {
        totalIncome: function () {
            let income = 0;
            for (let i = 0; i < this.items.length; i++) {
                if (this.items[i].income) {
                    income += parseFloat(this.items[i].itemAmount);
                }
            }

            return income;
        },
        totalExpense: function () {
            let expense = 0;
            for (let i = 0; i < this.items.length; i++) {
                if (!this.items[i].income) {
                    expense += parseFloat(this.items[i].itemAmount);
                }
            }

            return expense;
        },
        total: function () {
            let total = 0;
            total = parseFloat(totalIncome + totalExpense);

            return total;
        },
    },
};
</script>

<style>
h1 {
    letter-spacing: 1px;
    margin: 0;
}

h3 {
    border-bottom: 1px solid #bbb;
    padding-bottom: 10px;
    margin: 40px 0 10px;
}

h4 {
    margin: 0;
    text-transform: uppercase;
}

.tab-text {
    font-size: 16px;
}

.inc-exp-container {
    background-color: #fff;
    padding: 15px 0;
    display: flex;
    justify-content: space-between;
    margin: 15px 0;
}

.inc-exp-container > div {
    flex: 1;
    text-align: center;
}

.inc-exp-container > div:first-of-type {
    border-right: 1px solid #dedede;
}

.money {
    font-size: 20px;
    letter-spacing: 1px;
    margin: 5px 0;
}

.money.plus {
    color: #2ecc71;
}

.money.minus {
    color: #c0392b;
}

label {
    display: inline-block;
    margin: 10px 0;
    font-size: 18px;
}

input[type="text"],
input[type="number"] {
    border: 1px solid #dedede;
    border-radius: 2px;
    display: block;
    font-size: 16px;
    padding: 10px;
    width: 100%;
}
</style>
