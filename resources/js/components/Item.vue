<template>
    <li class="d-flex align-items-center listgroup-item">
        <div class="overflow-auto w-100">
            <div
                v-if="!editing"
                class="btn btn-2 border-0 flex-grow-1"
                v-bind:class="[income ? incomeClass : expenseClass]"
            >
                <span>{{ itemName }}</span>
            </div>
            <form v-else @submit.prevent="endEditingName()" class="d-flex flex-direction-row">
                <input
                    @blur="startEditingName()"
                    type="text"
                    class="form-control"
                    v-model="newItemName"
                />
            </form>
        </div>
        <div class="overflow-auto w-100">
            <div
                v-if="!editing"
                class="btn btn-2 border-0 flex-grow-1"
                v-bind:class="[income ? incomeClass : expenseClass]"
            >
                <span>{{ itemAmount }} ₹</span>
            </div>
            <form v-else @submit.prevent="endEditingAmount()" class="d-flex flex-direction-row">
                <input
                    @blur="startEditingAmount()"
                    type="number"
                    class="form-control"
                    v-model="newItemAmount"
                />
            </form>
        </div>
        <button @click="startEditingAmount()" class="btn btn-outline-primary ml-2">Edit</button>
        <button @click="$emit('on-delete')" class="btn btn-outline-primary ml-2">Delete</button>
    </li>
</template>

<script>
export default {
    props: {
        itemName: String,
        itemAmount: String,
        income: Boolean,
    },
    data() {
        return {
            newItemName: "",
            newItemAmount: "",
            editing: false,
            incomeClass: "alert-success",
            expenseClass: "alert-danger",
        };
    },
    methods: {
        startEditingName() {
            if (!this.editing) {
                this.newItemName = this.itemName;
                this.newItemAmount = this.itemAmount;
                this.editing = true;
            } else {
                this.endEditingName();
            }
        },
        endEditingName() {
            this.editing = false;
            this.$emit("on-edit-name", this.newItemName);
        },
        startEditingAmount() {
            if (!this.editing) {
                this.newItemName = this.itemName;
                this.newItemAmount = this.itemAmount;
                this.editing = true;
            } else {
                this.endEditingAmount();
            }
        },
        endEditingAmount() {
            this.editing = false;
            this.$emit("on-edit-amount", this.newItemAmount);
        },
    },
};
</script>
