<?php 
include "../db_conn.php";
$nomcommande=$_GET['nomcommande'];
?>
<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>
            commande de cartes <?php echo date('M Y'); ?>
        </title>
        <meta name="description" content="Export">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/app.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="css/datagrid/datatables/datatables.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
    </head>
    <body class="mod-bg-1">
        <script>
            /**
             *	This script should be placed right after the body tag for fast execution 
             *	Note: the script is written in pure javascript and does not depend on thirdparty library
             **/
            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
                /** 
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /** 
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);
            }
            /** 
             * Save to localstorage 
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
            /** 
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

        </script>
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper">
            <div class="page-inner">

  
                <div class="page-content-wrapper">
                    <!-- BEGIN Page Header -->
					
					<!--?php include('header.php'); ?-->
					<main id="js-page-content" role="main" class="page-content">
                        <ol class="breadcrumb page-breadcrumb">
                            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
								
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <!-- datatable start -->
                                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                                <thead class="bg-primary-600">
                                                    <tr>
                                                        <th> ID</th>
                                                        <th> IDType</th>
                                                        <th>IDNumber</th>
                                                        <th>IDExpiration</th>
                                                        <th>LastName</th>
                                                        <th>FirstName</th>
                                                        <th>pseudonyme</th>
                                                        <th>RaisonSociale</th>
                                                        <th>matricule</th>
                                                        <th>qualite</th>
                                                        <th>qrcode</th>
                                                        <th>DateAdhesion</th>
                                                        <th>City</th>
                                                        <th>Country</th>
                                                        <th>State</th>
                                                        <th>PostalCode</th>
                                                        <th>DateOfBirth</th>
                                                        <th> EmailAddress </th>
                                                        <th> HomePhone </th>
                                                        <th> OfficePhone</th>
                                                        <th> MobilePhone</th>
                                                        <th> PhotoReference</th>
                                                        <th> SalaryID</th>
                                                        <th> SolID</th>
                                                        <th> IDImage </th>
                                                        <th> STATUT </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT * FROM baseofficielle WHERE nomcommande = '$nomcommande'  ORDER BY id DESC";
                                                    $result = mysqli_query($conn, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)) {?>
                                                        <?php $statut=$row['statut'] ?>

                                                    <?php 
                                                        if ($statut=='NOK') { ?>     

                                                    
                                                        <tr style='background-color:red'>
                                                        <th><?php echo $row['id'] ?></th>
                                                        <th><?php echo $row['IDType'] ?></th>
                                                        <th><?php echo $row['IDNumber'] ?></th>
                                                        <th><?php echo $row['IDExpiration'] ?></th>
                                                        <th><?php echo $row['LastName'] ?></th>
                                                        <th><?php echo $row['FirstName'] ?></th>
                                                        <th><?php echo $row['pseudonyme'] ?></th>
                                                        <th><?php echo $row['RaisonSociale'] ?></th>
                                                        <th><?php echo $row['matricule'] ?></th>
                                                        <th><?php echo $row['qualite'] ?></th>
                                                        <th><?php echo $row['qrcode'] ?></th>
                                                        <th><?php echo $row['DateAdhesion'] ?></th>
                                                        <th><?php echo $row['City'] ?></th>
                                                        <th><?php echo $row['Country'] ?></th>
                                                        <th><?php echo $row['State'] ?></th>
                                                        <th><?php echo $row['PostalCode'] ?></th>
                                                        <th><?php echo $row['DateOfBirth'] ?></th>
                                                        <th><?php echo $row['EmailAddress'] ?></th>
                                                        <th><?php echo $row['HomePhone'] ?></th>
                                                        <th><?php echo $row['OfficePhone'] ?></th>
                                                        <th><?php echo $row['MobilePhone'] ?></th>
                                                        <th><?php echo $row['PhotoReference'] ?></th>
                                                        <th><?php echo $row['SalaryID'] ?></th>
                                                        <th><?php echo $row['SolID'] ?></th>
                                                        <th><?php echo $row['IDImage'] ?></th> 
                                                        <th><?php echo $row['statut'] ?></th> 
                                                    </tr>
													
                                                      
                                                      
                                                    <?php  } else {?>
                                                           
                                                       <tr>
                                                        <th><?php echo $row['id'] ?></th>
                                                        <th><?php echo $row['IDType'] ?></th>
                                                        <th><?php echo $row['IDNumber'] ?></th>
                                                        <th><?php echo $row['IDExpiration'] ?></th>
                                                        <th><?php echo $row['LastName'] ?></th>
                                                        <th><?php echo $row['FirstName'] ?></th>
                                                        <th><?php echo $row['pseudonyme'] ?></th>
                                                        <th><?php echo $row['RaisonSociale'] ?></th>
                                                        <th><?php echo $row['matricule'] ?></th>
                                                        <th><?php echo $row['qualite'] ?></th>
                                                        <th><?php echo $row['qrcode'] ?></th>
                                                        <th><?php echo $row['DateAdhesion'] ?></th>
                                                        <th><?php echo $row['City'] ?></th>
                                                        <th><?php echo $row['Country'] ?></th>
                                                        <th><?php echo $row['State'] ?></th>
                                                        <th><?php echo $row['PostalCode'] ?></th>
                                                        <th><?php echo $row['DateOfBirth'] ?></th>
                                                        <th><?php echo $row['EmailAddress'] ?></th>
                                                        <th><?php echo $row['HomePhone'] ?></th>
                                                        <th><?php echo $row['OfficePhone'] ?></th>
                                                        <th><?php echo $row['MobilePhone'] ?></th>
                                                        <th><?php echo $row['PhotoReference'] ?></th>
                                                        <th><?php echo $row['SalaryID'] ?></th>
                                                        <th><?php echo $row['SolID'] ?></th>
                                                        <th><?php echo $row['IDImage'] ?></th> 
                                                        <th><?php echo $row['statut'] ?></th> 
                                                    </tr>
													
                                                            <?php }  ?>    



													 <?php } ?> 
                                                </tbody>
                                            </table>
                                            <!-- datatable end -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                   
				   <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->

			


        <script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
    
	
        <script src="js/datagrid/datatables/datatables.bundle.js"></script>

        <script src="js/datagrid/datatables/datatables.export.js"></script>
        <script>
            $(document).ready(function()
            {

                // initialize datatable
                $('#dt-basic-example').dataTable(
                {
                    responsive: true,
                    lengthChange: false,
                    dom:
					
                        "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    buttons: [
                        /*{
                        	extend:    'colvis',
                        	text:      'Column Visibility',
                        	titleAttr: 'Col visibility',
                        	className: 'mr-sm-3'
                        },*/
                        {
                            extend: 'pdfHtml5',
                            text: 'PDF',
                            titleAttr: 'Générer PDF',
                            className: 'btn-outline-danger btn-sm mr-1'
                        },
                        {
                            extend: 'excelHtml5',
                            text: 'Excel',
                            titleAttr: 'Générer Excel',
                            className: 'btn-outline-success btn-sm mr-1'
                        },
                        {
                            extend: 'csvHtml5',
                            text: 'CSV',
                            titleAttr: 'Générer CSV',
                            className: 'btn-outline-primary btn-sm mr-1'
                        },
                        {
                            extend: 'copyHtml5',
                            text: 'Copier',
                            titleAttr: 'Copier en cliquant',
                            className: 'btn-outline-primary btn-sm mr-1'
                        },
                        {
                            extend: 'print',
                            text: 'Imprimer',
                            titleAttr: 'Imprimer Tableau',
                            className: 'btn-outline-primary btn-sm'
                        }
                    ]
                });

            });

        </script>
    </body>
</html>
