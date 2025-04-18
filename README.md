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

## 🛠️ Technical Implementation

### Domain Models

| Model                | Description                                                                 | Key Attributes                          |
|----------------------|-----------------------------------------------------------------------------|-----------------------------------------|
| **Warehouse**        | Physical storage locations                                                 | `name`, `location`, `capacity`         |
| **Item**             | Inventory items with [auto-generated codes](#-code-generation-logic)        | `name`, `commercial_name`, `code`, `category_id` |
| **Transaction**      | Movement records (IN/OUT) with audit trail                                  | `transaction_type_id`, `warehouse_id`, `status` |
| **TransactionType**  | Classification (Purchase/Sale/Return/etc.)                                  | `name`, `flow` (`in`/`out`)            |



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


