# 🏭 Warehouse Management System RESTFUL-API


A modern warehouse management system built with **Laravel 12** using Repository-Service pattern for clean architecture.

## ✨ Features

- **Inventory Tracking** (Inbound/Outbound)
- **Auto-generated Item Codes** (Smart formatting)
- **Transaction Reversal System**
- **Real-time Stock Reports**

## 🛠️ Technology Stack

| Category       | Technology              | Version |
|---------------|-------------------------|---------|
| Framework     | Laravel                 | 12.x    |
| Language      | PHP                     | 8.2+    |
| Database      | MySQL                   | 8.0+    |


## 🛠️ Technical Implementation

### Domain Models

| Model                | Description                                                                 | Key Attributes                          |
|----------------------|-----------------------------------------------------------------------------|-----------------------------------------|
| **Warehouse**        | Physical storage locations                                                  | `name`, `location`, `capacity`         |
| **Item Category**    | Category for item                                                           | `name`|
| **Item**             | Inventory items                                                             | `name`, `commercial_name`, `code`, `category_id` |
| **TransactionType**  | Classification (Purchase/Sale/Return/etc.)                                  | `name`, `flow` (`in`/`out`/`adjustment in`/`adjustment out`)   |
| **InTransaction**    | Movement records (IN)                                                       | `item_id`, `quantity`, `warehouse_transaction_id` |
| **OutTransaction**   | Movement records (OUT) with audit trail                                     | `item_id`, `quantity`, `warehouse_transaction_id` |




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


