<template>
    <li class="d-flex align-items-center listgroup-item">
        <div class="overflow-auto w-100">
            <div
                v-if="!editing"
                class="btn btn-2 border-0 flex-grow-1"
                v-bind:class="[item_is_income === 1 ? incomeClass : expenseClass]"
            >
                <span>{{ item_name }}</span>
            </div>
            <form v-else @submit.prevent="endEditingName(tab_id)" class="d-flex flex-direction-row">
                <input
                    @blur="startEditingName(item_id, tab_id)"
                    type="text"
                    class="form-control"
                    v-model="item.item_name"
                />
            </form>
        </div>
        <div class="overflow-auto w-100">
            <div
                v-if="!editing"
                class="btn btn-2 border-0 flex-grow-1"
                v-bind:class="[item_is_income === 1 ? incomeClass : expenseClass]"
            >
                <span>{{ item_amount }} ₹</span>
            </div>
            <form
                v-else
                @submit.prevent="endEditingAmount(tab_id)"
                class="d-flex flex-direction-row"
            >
                <input
                    @blur="startEditingAmount(item_id, tab_id)"
                    type="number"
                    class="form-control"
                    v-model="item.item_amount"
                />
            </form>
        </div>
        <button @click="startEditingAmount(item_id, tab_id)" class="btn btn-warning ml-2">Edit</button>
        <button @click="$emit('on-delete')" class="btn btn-danger ml-2">Delete</button>
    </li>
</template>

<script>
export default {
    props: {
        item_id: Number,
        item_name: String,
        item_amount: String,
        item_is_income: Number,
        tab_id: Number,
    },
    data() {
        return {
            items: [],
            item: {
                id: "",
                item_name: "",
                item_amount: "",
            },
            editing: false,
            incomeClass: "alert-success",
            expenseClass: "alert-danger",
        };
    },
    methods: {
        startEditingName(item_id, tab_id) {
            if (!this.editing) {
                this.editing = true;
                this.item.id = item_id;
                this.item.item_id = item_id;
                this.item.item_name = this.item_name;
                this.item.item_amount = this.item_amount;
            } else {
                this.endEditingName(tab_id);
            }
        },
        endEditingName(tab_id) {
            this.editing = false;

            //  Update item name based on curent tab and current user
            fetch("api/item/" + tab_id + "/" + this.$user_id, {
                method: "put",
                body: JSON.stringify(this.item),
                headers: {
                    "Content-Type": "application/json",
                },
            })
                .then((res) => res.json())
                .then((data) => {
                    this.$emit("on-fetch-items");
                })
                .catch((error) => console.log(error));
        },
        startEditingAmount(item_id, tab_id) {
            if (!this.editing) {
                this.editing = true;
                this.item.id = item_id;
                this.item.item_id = item_id;
                this.item.item_name = this.item_name;
                this.item.item_amount = this.item_amount;
            } else {
                this.endEditingAmount(tab_id);
            }
        },
        endEditingAmount(tab_id) {
            this.editing = false;

            //  Update item amount based on curent tab and current user
            fetch("api/item/" + tab_id + "/" + this.$user_id, {
                method: "put",
                body: JSON.stringify(this.item),
                headers: {
                    "Content-Type": "application/json",
                },
            })
                .then((res) => res.json())
                .then((data) => {
                    this.$emit("on-fetch-items");
                })
                .catch((error) => console.log(error));
        },
    },
};
</script>
