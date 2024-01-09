<?php

// Function to generate more detailed dummy data for different types
function generateDetailedDummyData($count, $type) {
    $data = array();
    for ($i = 1; $i <= $count; $i++) {
        $item = array(
            'id' => $i,
            'details' => 'Details for ' . $type . ' ' . $i,
            // Add other details specific to the type
        );

        switch ($type) {
            case 'contacts':
                $item['contact_name'] = ucfirst($type) . ' User ' . $i;
                $item['contact_email'] = strtolower($type) . '_user' . $i . '@example.com';
                $item['contact_phone'] = '555-123-' . str_pad($i, 4, '0', STR_PAD_LEFT);
                break;
            case 'deals':
                $item['deal_name'] = ucfirst($type) . ' ' . $i;
                $item['deal_description'] = 'Description for ' . $type . ' ' . $i;
                $item['deal_amount'] = rand(10000, 100000);
                break;
            case 'organizations':
                $item['organization_name'] = ucfirst($type) . ' ' . $i;
                $item['organization_type'] = 'Type for ' . $type . ' ' . $i;
                $item['organization_address'] = array(
                    'street' => 'Street ' . $i,
                    'city' => 'City ' . $i,
                    'state' => 'State ' . $i,
                    'zip' => 'Zip ' . $i,
                );
                break;
            case 'funds':
                $item['fund_name'] = ucfirst($type) . ' ' . $i;
                $item['fund_type'] = 'Type for ' . $type . ' ' . $i;
                $item['fund_investment'] = rand(100000, 1000000);
                break;
            case 'portfolios':
                $item['portfolio_name'] = ucfirst($type) . ' ' . $i;
                $item['portfolio_description'] = 'Description for ' . $type . ' ' . $i;
                $item['portfolio_value'] = rand(1000000, 10000000);
                break;
            case 'investors':
                $item['investor_name'] = ucfirst($type) . ' ' . $i;
                $item['investor_type'] = 'Type for ' . $type . ' ' . $i;
                $item['investor_email'] = strtolower($type) . '_investor' . $i . '@example.com';
                break;
            case 'documents':
                $item['document_name'] = ucfirst($type) . ' ' . $i;
                $item['document_type'] = 'Type for ' . $type . ' ' . $i;
                $item['document_size'] = rand(100, 1000).' MB';
                break;
        }

        $data[] = $item;
    }
    return $data;
}

// Function to filter data based on search term
function filterData($data, $searchTerm) {
    return array_filter($data, function ($item) use ($searchTerm) {
        foreach ($item as $key => $value) {
            if (is_string($value) && stripos($value, $searchTerm) !== false) {
                return true;
            }
        }
        return false;
    });
}

// Function to limit the number of items
function limitData($data, $limit) {
    return array_slice($data, 0, $limit);
}

// Get parameters from the request
$type = isset($_GET['type']) ? $_GET['type'] : 'contacts';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : PHP_INT_MAX;

// Generate more detailed dummy data based on the specified type
switch ($type) {
    case 'contacts':
        $data = generateDetailedDummyData(50, 'contacts');
        break;
    case 'deals':
        $data = generateDetailedDummyData(50, 'deals');
        break;
    case 'organizations':
        $data = generateDetailedDummyData(50, 'organizations');
        break;
    case 'funds':
        $data = generateDetailedDummyData(50, 'funds');
        break;
    case 'portfolios':
        $data = generateDetailedDummyData(50, 'portfolios');
        break;
    case 'investors':
        $data = generateDetailedDummyData(50, 'investors');
        break;
    case 'documents':
        $data = generateDetailedDummyData(50, 'documents');
        break;
    default:
        $data = generateDetailedDummyData(50, 'contacts');
}

// Filter data based on search term
$filteredData = empty($search) ? $data : filterData($data, $search);

// Limit data based on the specified limit
$limitedData = limitData($filteredData, $limit);

// Return JSON response
header('Content-Type: application/json');
echo json_encode($limitedData);

?>
