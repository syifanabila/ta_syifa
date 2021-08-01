					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex align-items-center flex-wrap mr-1">
									<!--begin::Page Heading-->
									<div class="d-flex align-items-baseline flex-wrap mr-5">
										<!--begin::Page Title-->
										<h2 class="text-dark font-weight-bold my-1 mr-5">Hasil Perhitungan dari Keyword : <?php echo $query['keyword'] ?></h2> <br>
                                        <p>Pada <?php echo date('d F Y H.i A', strtotime( $query['created_at'] )) ?></p>
										<!--end::Page Title-->
									</div>
									<!--end::Page Heading-->
								</div>
								<!--end::Info-->
							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<div class="row">
                                    <div class="col-md-6">
                                        <!--begin::Card-->
                                        <div class="card card-custom gutter-b">
                                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                                <div class="card-title">
                                                    <h3 class="card-label">Term Frequency
                                                    <span class="d-block text-muted pt-2 font-size-sm">Daftar Sampel Query</span></h3>
                                                </div>
                                            </div>
                                            <div class="card-body">

                                                <table class="table" id="kt_datatable">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">Query</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <!--begin::Card-->
                                        <div class="card card-custom gutter-b">
                                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                                <div class="card-title">
                                                    <h3 class="card-label">Normalize Term Frequency
                                                    <span class="d-block text-muted pt-2 font-size-sm">Daftar Sampel Query</span></h3>
                                                </div>
                                            </div>
                                            <div class="card-body">

                                                <table class="table" id="ntf">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">Query</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <!--begin::Card-->
                                        <div class="card card-custom gutter-b">
                                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                                <div class="card-title">
                                                    <h3 class="card-label">IDF
                                                    <span class="d-block text-muted pt-2 font-size-sm">Daftar Sampel Query</span></h3>
                                                </div>
                                            </div>
                                            <div class="card-body">

                                                <table class="table" id="idf">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">Kata</th>
                                                            <th scope="col">IDF</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!--begin::Card-->
                                        <div class="card card-custom gutter-b">
                                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                                <div class="card-title">
                                                    <h3 class="card-label">Term Query
                                                    <span class="d-block text-muted pt-2 font-size-sm">Daftar Sampel Query</span></h3>
                                                </div>
                                            </div>
                                            <div class="card-body">

                                                <table class="table" id="term_query">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">data</th>
                                                            <th scope="col">result</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4">
                                        <!--begin::Card-->
                                        <div class="card card-custom gutter-b">
                                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                                <div class="card-title">
                                                    <h3 class="card-label">Query TF
                                                    <span class="d-block text-muted pt-2 font-size-sm">Daftar Sampel Query</span></h3>
                                                </div>
                                            </div>
                                            <div class="card-body">

                                                <table class="table" id="q_tf">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">query</th>
                                                            <th scope="col">result</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!--begin::Card-->
                                        <div class="card card-custom gutter-b">
                                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                                <div class="card-title">
                                                    <h3 class="card-label">Query IDF
                                                    <span class="d-block text-muted pt-2 font-size-sm">Daftar Sampel Query</span></h3>
                                                </div>
                                            </div>
                                            <div class="card-body">

                                                <table class="table" id="q_idf">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">query</th>
                                                            <th scope="col">result</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!--begin::Card-->
                                        <div class="card card-custom gutter-b">
                                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                                <div class="card-title">
                                                    <h3 class="card-label">Query TF-IDF
                                                    <span class="d-block text-muted pt-2 font-size-sm">Daftar Sampel Query</span></h3>
                                                </div>
                                            </div>
                                            <div class="card-body">

                                                <table class="table" id="q_tf-idf">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">query</th>
                                                            <th scope="col">result</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->


                    <script>
                        
                        var table = $('#kt_datatable');

                        // begin first table
                        table.DataTable({
                            responsive: true,
                            ajax: {
                                url: HOST_URL + 'tfidf/tf/<?php echo $id_query ?>',
                                type: 'POST',
                                data: {
                                    pagination: {
                                        perpage: 50,
                                    },
                                },
                            },
                            columns: [
                                {data: 'RecordID'},
                                {data: 'text'}
                            ],

                        })
                    </script>


                    <script>
                        
                        var table = $('#ntf');

                        // begin first table
                        table.DataTable({
                            responsive: true,
                            ajax: {
                                url: HOST_URL + 'tfidf/ntf/<?php echo $id_query ?>',
                                type: 'POST',
                                data: {
                                    pagination: {
                                        perpage: 5,
                                    },
                                },
                            },
                            columns: [
                                {data: 'RecordID'},
                                {data: 'text'}
                            ],

                        })
                    </script>
                    
                    
                    
                    
                    <script>
                        
                        var table = $('#idf');

                        // begin first table
                        table.DataTable({
                            responsive: true,
                            ajax: {
                                url: HOST_URL + 'tfidf/idf/<?php echo $id_query ?>',
                                type: 'POST',
                                data: {
                                    pagination: {
                                        perpage: 5,
                                    },
                                },
                            },
                            columns: [
                                {data: 'RecordID'},
                                {data: 'text'},
                                {data: 'idf'}
                            ],

                        })
                    </script>


                    <script>
                        
                        var table = $('#term_query');

                        // begin first table
                        table.DataTable({
                            responsive: true,
                            ajax: {
                                url: HOST_URL + 'tfidf/term_query/<?php echo $id_query ?>',
                                type: 'POST',
                                data: {
                                    pagination: {
                                        perpage: 5,
                                    },
                                },
                            },
                            columns: [
                                {data: 'RecordID'},
                                {data: 'doc'},
                                {data: 'value'}
                            ],

                        })
                    </script>
                    
                    
                    
                    
                    
                    
                    
                    
                    <script>
                        
                        // query tf
                        query_t('q_tf', 'TF');                        
                        query_t('q_idf', 'IDF');                        
                        query_t('q_tf-idf', 'TF-IDF');                        

                        function query_t( tableId, type ) {

                            let table = $('#'+tableId);

                            // begin first table
                            table.DataTable({
                                responsive: true,
                                searching: false,
                                ajax: {
                                    url: HOST_URL + 'tfidf/query_t/'+ type +'/<?php echo $id_query ?>',
                                    type: 'POST',
                                    data: {
                                        pagination: {
                                            perpage: 5,
                                        },
                                    },
                                },
                                columns: [
                                    {data: 'RecordID'},
                                    {data: 'doc'},
                                    {data: 'value'}
                                ],

                            })
                        }

                        
                    </script>