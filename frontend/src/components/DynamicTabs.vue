<script>
    export default {
        data() {
            return {
                tabIndex: 1,
                checkStatus: false,
                inciTable: [],
            }
        },
        methods: {
            setTabindex(index) {
                this.tabIndex = index;
            },
            setCheckstatus(status) {
                this.checkStatus = status;
            },
            setIncitable(ix, state) {
                this.inciTable.push({index: ix, status: state});
            },
            setCheckstat(i, state2) {
                this.inciTable[i].status = state2;
                 //console.log(this.inciTable[i].status, state2)
                //this.inciTable.push({index: i, status: state2});
                console.log(JSON.stringify(this.inciTable));
            }
        },
    }
</script>

<template>
    <div>
        <slot :tabIndex="tabIndex" :setTabindex="setTabindex"
        :setIncitable="setIncitable" :inciTable="inciTable" :setCheckstat="setCheckstat"></slot>
    </div>
</template>