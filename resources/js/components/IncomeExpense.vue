<template>
    <div class>
        <div class="mr-4 ml-4 pr-1 pl-1 pt-2 pb-4">
            <form @submit.prevent="addTab">
                <div class="form-group text-center">
                    <label for="tab" class>Add Tab</label>
                    <input
                        v-model="tab.tab_name"
                        type="text"
                        class="form-control"
                        id="tab"
                        placeholder="Enter Tab Name..."
                    />
                </div>
                <button type="submit" class="btn btn-primary btn-block">Add / Edit</button>
            </form>
        </div>
        <div class="mr-4 ml-4">
            <ul
                class="nav nav-pills nav-fill justify-content-center tab-text pb-4"
                id="myTab"
                role="tablist"
            >
                <li
                    class="nav-item m-1"
                    role="presentation"
                    v-for="(tab, index) in tabs"
                    :key="index"
                >
                    <a
                        class="nav-link nav-link-vertical"
                        :id="tab.tab_name+'-tab'"
                        data-toggle="tab"
                        :href="'#'+tab.tab_name"
                        role="tab"
                        :aria-controls="tab.tab_name"
                        aria-selected="true"
                    >{{ tab.tab_name }}</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div
                    v-for="(tab, index) in tabs"
                    :key="index"
                    class="tab-pane fade show"
                    :id="tab.tab_name"
                    role="tabpanel"
                    :aria-labelledby="tab.tab_name+'-tab'"
                >
                    <tab :tab="tab" :tab_name="tab.tab_name"></tab>
                    <div class="pr-3 pl-3 mb-4">
                        <div class="row">
                            <div class="col">
                                <button
                                    @click="editTab(tab)"
                                    class="btn btn-warning btn-block"
                                >Edit {{ tab.tab_name }}</button>
                            </div>
                            <div class="col">
                                <button
                                    @click="deleteTab(tab.id)"
                                    class="btn btn-danger btn-block"
                                >Delete {{ tab.tab_name }}</button>
                            </div>
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
    data() {
        return {
            tabs: [],
            tab: {
                id: "",
                tab_name: "",
            },
            tab_id: "",
            editing: false,
        };
    },
    created() {
        this.fetchTabs();
    },
    methods: {
        fetchTabs() {
            fetch("api/tabs/" + this.$user_id)
                .then((res) => res.json())
                .then((res) => {
                    this.tabs = res.data;
                });
        },
        addTab() {
            if (this.editing === false) {
                fetch("api/tab/" + this.$user_id, {
                    method: "post",
                    body: JSON.stringify(this.tab),
                    headers: {
                        "Content-Type": "application/json",
                    },
                })
                    .then((res) => res.json())
                    .then((data) => {
                        this.tab.tab_name = "";
                        this.fetchTabs();
                    })
                    .catch((error) => console.log(error));
            } else {
                fetch("api/tab/" + this.$user_id, {
                    method: "put",
                    body: JSON.stringify(this.tab),
                    headers: {
                        "Content-Type": "application/json",
                    },
                })
                    .then((res) => res.json())
                    .then((data) => {
                        Swal.fire({
                            title: "Tab Name Updated!",
                            text: "Wait for page reload",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "OK",
                        }).then((result) => {
                            if (result.value) {
                                this.tab.tab_name = "";
                                window.location.reload();
                            }
                        });
                    })
                    .catch((error) => console.log(error));
            }
        },
        editTab(tab) {
            Swal.fire({
                title: "Edit Tab Name!",
                text: "You can edit name in the Tab section above.",
                icon: "info",
            }).then((result) => {
                if (result.value) {
                    this.editing = true;
                    this.tab.id = tab.id;
                    this.tab.tab_id = tab.id;
                    this.tab.tab_name = tab.tab_name;
                    window.scrollTo(0, 0);
                }
            });
        },
        deleteTab(id) {
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
                    fetch("api/tab/" + id + "/" + this.$user_id, {
                        method: "delete",
                    })
                        .then((res) => res.json())
                        .then((data) => {
                            this.fetchTabs();
                        })
                        .catch((error) => console.log(error));
                    Swal.fire("Deleted!", "Tab has been deleted.", "success");
                }
            });
        },
    },
};
</script>

<style>
html {
    scroll-behavior: smooth;
}

hr {
    margin-top: 10px;
    height: 1px;
    border: 0;
    color: #bbbbbb;
    background-color: #bbbbbb;
}

.marg {
    margin-top: 25px;
}

.nav-link-vertical {
    background-color: #d8d8d8;
    color: #9e9e9e;
}

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
