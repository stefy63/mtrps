<script>
    document.addEventListener('alpine:init', () => {

        Alpine.data('buttonModalHandler', (config) => {
            return {
                endpoint: config.endpoint || '',
                label: config.label || '',
                url: config.url || '',
                modalTitle: config.modalTitle || '',
                modalClass: config.modalClass || '',
                class: config.class || '',
                icon: config.icon || '',

                openModal() {
                    Alpine.store('modal').open({
                        url: this.url,
                        title: this.modalTitle,
                        endpoint: this.endpoint,
                        modalClass: this.modalClass,
                        onSelect: (newItem) => {
                            console.log(newItem)
                            // this.options.push(newItem);
                            // this.option_id = newItem[this.idKey];
                            // this.search = newItem[this.labelKey];
                        },
                    });
                },
            }
        });

        Alpine.data('modalHandler', () => {
            return {
                modalTitle: 'Nuovo Inserimento',
                modalContent: '',
                endpoint: '',
                labelKey: '',
                idKey: '',
                loading: true,
                myModal: null,
                onSelect: null,
                modalClass: '',

                async loadModal({url, title, endpoint, idKey, labelKey, modalClass, onSelect}) {
                    this.loading = true;
                    Object.assign(this, {
                        modalTitle: title,
                        endpoint,
                        idKey,
                        labelKey,
                        onSelect,
                        modalClass
                    });

                    try {
                        let response = await fetch(url, {
                            headers: {"X-Requested-With": "XMLHttpRequest"}
                        });
                        this.modalContent = await response.text();
                    } catch (e) {
                        this.modalContent = '<p>Errore nel caricamento del form</p>';
                    } finally {
                        this.loading = false;
                    }
                    const modalEl = document.getElementById('dinamicModal');
                    this.myModal = new bootstrap.Modal(modalEl);
                    modalEl.addEventListener('hidden.bs.modal', () => {
                        this.modalContent = '';
                    });
                    this.myModal.show();

                },

                saveData(event) {
                    event.preventDefault();
                    const form = new FormData(this.$refs.innerForm);
                    const formData = Object.fromEntries(form.entries());

                    fetch(this.endpoint, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify(formData)
                    }).then(response => {
                        if (!response.ok) {
                            console.log(response);
                            return false;
                        }
                        return response.json();
                    }).then((data) => {
                        if (data) {
                            if (typeof this.onSelect === 'function') {
                                this.onSelect(data.data);
                            }
                            Swal.fire({
                                icon: 'success',
                                title: 'Salvato!',
                                text: data.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Errore!',
                            text: 'Salvataggio non riuscito.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }).finally(() => {
                        this.modalContent = '';
                        this.myModal.hide();
                    });
                }
            }
        });

        Alpine.data('dynamicSelect', (config) => {
            let oldSearch;
            let oldId;
            if (config.value) {
                const old = config.options.find(o => o[config.idKey] === +config.value);
                oldId = config.option_id = old[config.idKey] || '';
                oldSearch = config.search = old[config.labelKey] || '';
            }
            return {
                required: config.required || false,
                search: config.search || '',
                selected: config.selected || {},
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
                modalClass: config.modalClass || '',
                class: config.class || '',

                getClass() {
                    return "form-group mb-2 " + this.class
                },
                clearSearch() {
                    this.search = null;
                    this.option_id = null;
                    oldSearch = null;
                    oldId = null;
                },

                oldSearch() {
                    if (!this.search && !this.option_id) {
                        this.search = oldSearch || ''
                        this.option_id = oldId || null
                        this.open = false
                    } else {
                        oldSearch = this.search
                        oldId = this.option_id
                    }
                },

                get filteredOptions() {
                    if (this.search === '') return this.options;
                    return this.options.filter(o =>
                        o[this.labelKey].toLowerCase().includes(this.search.toLowerCase())
                    );
                },


                openParentModal() {
                    Alpine.store('modal').open({
                        url: this.modalUrl,
                        title: this.modalTitle,
                        endpoint: this.endpoint,
                        idKey: this.idKey,
                        labelKey: this.labelKey,
                        modalClass: this.modalClass,
                        onSelect: (newItem) => {
                            this.options.push(newItem);
                            this.option_id = newItem[this.idKey];
                            this.search = newItem[this.labelKey];
                        },
                    });
                },
            }
        })

        Alpine.store('modal', {
            open(config) {
                const modalComp = Alpine.$data(document.querySelector('#dinamicModal'));
                modalComp.loadModal(config);
            }
        });


    })
</script>
