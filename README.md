# 🏭 Warehouse Management System RESTFUL-API

A modern warehouse management system built with *Laravel 12* using Repository-Service pattern for clean architecture.

## ✨ Features

- *Inventory Tracking* (Inbound/Outbound)
- *Auto-generated Item Codes* (Smart formatting)
- *Transaction Reversal System*
- *Real-time Stock Reports*

## 🛠️ Technology Stack

| Category  | Technology | Version |
| --------- | ---------- | ------- |
| Framework | Laravel    | 12.x    |
| Language  | PHP        | 8.2+    |
| Database  | MySQL      | 8.0+    |

## 🏗️ Architecture Overview

This system follows a *layered architecture* to ensure clean separation of concerns, maintainability, and ease of testing. The architecture consists of the following layers:

1. *Model Layer*:  
   - The *Model* layer represents the structure of the database tables (e.g., Item, Transaction, etc.).  
   - It interacts directly with the database but does not contain complex business logic or complex data aggregations & queries.

2. *Repository Layer*:  
   - The *Repository* layer abstracts all data operations (e.g., queries, aggregations) from the models.  
   - It handles database operations such as retrieving, updating, and deleting records.  
   - This layer ensures that the *Service* layer doesn't need to interact directly with the database.

3. *Service Layer*:  
   - The *Service* layer contains the *business logic* of the application.  
   - It coordinates the interactions between the Repository layer and the Controller layer.  
   - Business rules (e.g., inventory checks, stock adjustments, transaction validation) are applied in this layer.

4. *Controller Layer*:  
   - The *Controller* is the entry point for the API.  
   - It handles incoming HTTP requests, validates the input data, and passes it to the appropriate *Service* layer methods.  
   - The controller is responsible for returning responses in the appropriate format (e.g., JSON).

mermaid
graph TD
    A[API Controllers] --> B[Services]
    B --> C[Repositories]
    C --> D[Models]
    D --> E[(Database)]

---

### 🚀 *Dependency Injection & Testability*

The system uses *dependency injection* to make it easy to replace components and test individual layers in isolation. This approach allows for greater flexibility and makes unit and integration testing more efficient.

- *Dependency Injection*: Through dependency injection, the system injects dependencies such as services and repositories into the controllers and services. This ensures that components can be easily replaced or updated without affecting the rest of the system.
  
- *Mocking for Tests*: During testing, it's possible to inject mock versions of the dependencies, such as the repository or service, which allows us to test the business logic without needing a live database or external resources.
  
- *Separation of Concerns*: Each layer is decoupled, ensuring that business logic, database access, and HTTP handling are kept separate. This not only improves maintainability but also ensures that developers can work on individual components without interfering with others.

---

## 🛠️ Technical Implementation

### Domain Models

| Model                | Description                                                                 | Key Attributes                          |
|----------------------|-----------------------------------------------------------------------------|-----------------------------------------|
| *Warehouse*        | Physical storage locations                                                  | name, location, capacity         |
| *Item Category*    | Category for item                                                           | name|
| *Item*             | Inventory items                                                             | name, commercial_name, code, category_id |
| *TransactionType*  | Classification (Purchase/Sale/Return/etc.)                                  | name, flow (in/out/adjustment in/adjustment out)   |
| *InTransaction*    | Movement records (IN)                                                       | item_id, quantity, warehouse_transaction_id |
| *OutTransaction*   | Movement records (OUT) with audit trail                                     | item_id, quantity, warehouse_transaction_id |


## 🚀 API Documentation

[![Postman Collection](https://img.shields.io/badge/Postman-Collection-orange)]()

### Direct Links
- [Download Collection](Docs/warehouse_management.postman_collection.json)

## 📡 API Response Structure

### Consistent Response Format
All API responses follow this standardized JSON structure:

*Success Response*:
```json
{
  "status": "success",
  "code": 200,
  "data": {
    /* endpoint-specific data */
  },
  "meta": {
    /* pagination/aggregation data */
  }
}
