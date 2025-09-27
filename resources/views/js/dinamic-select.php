<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('formPage', () => {
            return {
                modalTitle: 'Nuovo Inserimento',
                modalContent: '',
                endpoint: '',
                labelKey: '',
                idKey: '',
                optionsRef: null,
                selectedRef: null,
                newLabel: '',

                async loadModal(url, title, optionsRef, selectedRef, endpoint, idKey, labelKey) {
                    this.modalTitle += title;
                    this.endpoint = endpoint;
                    this.idKey = idKey;
                    this.labelKey = labelKey;
                    this.optionsRef = optionsRef;
                    this.selectedRef = selectedRef;

                    let response = await fetch(url, {
                        headers: {"X-Requested-With": "XMLHttpRequest"}
                    });
                    this.modalContent = await response.text();
                    // let myModal = new bootstrap.Modal(document.getElementById('dinamicModal'));
                    // myModal.show();
                    this.$nextTick(() => {
                        let existingModal = bootstrap.Modal.getInstance(document.getElementById('dinamicModal'));
                        if (existingModal) existingModal.dispose();
                        const myModal = new bootstrap.Modal(document.getElementById('dinamicModal'));

                        myModal.show();
                    });
                },

                async saveData() {
                    const formContainer = this.$refs.modalFormContainer;
                    // const formContainer = document.getElementById('modalForm');
                    // const formEl = formContainer.querySelector('form');
                    console.log('Form Element:', formContainer);
                    // const formData = new FormData(formEl);
                    // const serializedData = Object.fromEntries(formData.entries());
                    // console.log('Dati serializzati:', serializedData);
                    // if (this.newLabel.trim() === '') return;
                    //
                    // let response = await fetch(this.endpoint, {
                    //     method: "POST",
                    //     headers: {
                    //         "Content-Type": "application/json",
                    //         "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    //     },
                    //     body: JSON.stringify({[this.labelKey]: this.newLabel})
                    // });
                    //
                    // let data = await response.json();
                    // this.optionsRef.push(data);
                    // this.selectedRef = data[this.idKey];
                    // this.newLabel = '';
                }
            }
        });

        Alpine.data('dynamicSelect', (config) => {
            if (config.value) {
                const old = config.options.find(o => o[config.idKey] === +config.value);
                config.option_id = old[config.idKey] || '';
                config.search = old[config.labelKey] || '';
            }
            return {
                required: config.required || false,
                search: config.search || '',
                selected: null,
                errors: config.errors,
                options: config.options,
                endpoint: config.endpoint,
                idKey: config.idKey,
                labelKey: config.labelKey,
                label: config.label,
                modalUrl: config.modalUrl,
                modalTitle: config.modalTitle,
                option_id: config.option_id || '',
                open: false,
                isInvalid: Object.keys(config.errors).includes('car_type_id') || false,

                get filteredOptions() {
                    if (this.search === '') return this.options;
                    return this.options.filter(o =>
                        o[this.labelKey].toLowerCase().includes(this.search.toLowerCase())
                    );
                },

                openParentModal() {
                    this.loadModal(
                        this.modalUrl,
                        this.modalTitle,
                        this.options,
                        this.selected,
                        this.endpoint,
                        this.idKey,
                        this.labelKey
                    );
                }
            }
        })
    })
</script>
