#  Warehouse Management System RESTFUL-API


A modern warehouse management system built with **Laravel 12** using Repository-Service pattern for clean architecture.

##  Features

- **Inventory Tracking** (Inbound/Outbound)
- **Auto-generated Item Codes** (Smart formatting)
- **Transaction Reversal System**
- **Real-time Stock Reports**

## Technologies Used

-Backend: [Larave,PHP]
-Database: [MySQl]


## 🚀 API Documentation

[![Postman Collection](https://img.shields.io/badge/Postman-Collection-orange)]()

### Direct Links
- [Download Collection](Docs/warehouse_management.postman_collection.json)





## 🏗️ Architecture

```mermaid
graph TD
    A[API Controllers] --> B[Services]
    B --> C[Repositories]
    C --> D[Models]
    D --> E[(Database)]


