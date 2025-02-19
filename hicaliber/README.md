<p align="center"><a href="https://career.habr.com/companies/hicaliber" target="_blank">
<img src="https://habrastorage.org/getpro/moikrug/uploads/company/100/005/289/7/logo/medium_ba0b3359bd1955478ee7d39b6fd7b437.png" width="400" alt="Laravel Logo"></a></p>

# The Hicaliber test
- [The link to the task description](https://github.com/emisdb/luxus/blob/master/hicaliber/task.md)
- [The link to this file](https://github.com/emisdb/luxus/tree/master/hicaliber#readme)

This test was accomplished in the environment of my test platform that is available on [my Githab repository](https://github.com/emisdb/luxus).
The task was completed in the Laravel framework with the use of the best practices for this framework following the SOLID principles.

## Backend
- On the  basis of [csv](https://github.com/emisdb/luxus/blob/master/database/property-data.csv) file [migration](https://github.com/emisdb/luxus/blob/master/database/migrations/2024_03_12_114751_create_property_data_table.php) and [seeder](https://github.com/emisdb/luxus/blob/master/database/seeders/PropertyDataSeeder.php) were built. The [SQL dump file](https://github.com/emisdb/luxus/blob/master/database/property_data.sql) for the created table also available.  
- The model [PropertyData](https://github.com/emisdb/luxus/blob/master/app/Models/PropertyData.php) was built for the data access and management. Business Logic was encapsulated here.
- The resource [PropertyDataResource](https://github.com/emisdb/luxus/blob/master/app/Http/Resources/PropertyDataResource.php) for data formatting
- The controller  [PropertyDataController](https://github.com/emisdb/luxus/blob/master/app/Http/Controllers/PropertyDataController.php)
- The rout file [api.php](https://github.com/emisdb/luxus/blob/master/routes/api.php#L27) was edited for the purpose of api route registering.

The required API has been provided for the test application. I believe that the majority of the business logic should be transferred to the service layer and registered within the service provider. However, given the application's size, I have opted to refrain from creating unnecessary modules.
## Frontend
Two frontend pages were created.
### Native Vue 3 solution
- [Blade view "search"](https://github.com/emisdb/luxus/blob/master/resources/views/vue/search.blade.php) was created
- [Layout module "admin"](https://github.com/emisdb/luxus/blob/master/resources/views/vue/layout/admin.blade.php) was used to provide the Admin panel for test display
- [Vite config](https://github.com/emisdb/luxus/blob/master/vite.config.js#L10) was ussed to provide vue dependancy
- In the file [app.js](https://github.com/emisdb/luxus/blob/master/resources/js/app.js) all components and router were set.
- In the file [routes.js](https://github.com/emisdb/luxus/blob/master/resources/js/routes.js#L13) all routes for vue-router were set.
- [Side-bar view "sidebar"](https://github.com/emisdb/luxus/blob/master/resources/views/vue/layout/sidebar.blade.php) navigation was set for vue-router management 
- Component [SearchAdvancedComponent](https://github.com/emisdb/luxus/blob/master/resources/js/components/hic/SearchAdvancedComponent.vue) was created for the table display
- In the [routes/web.php](https://github.com/emisdb/luxus/blob/master/routes/web.php#L42) special route for all vue elements was set: **/hic/{any?}**
### Vue 3 with Element UI solution
- To plug in the Element UI [vite config](https://github.com/emisdb/luxus/blob/master/vite.config.js#L6) was edited.
- The same blade template was used for this variant, all rendering was set in the [Vue-router](https://github.com/emisdb/luxus/blob/master/resources/js/routes.js#L16).
- Component [SearchElementComponent](https://github.com/emisdb/luxus/blob/master/resources/js/components/hic/SearchElementComponent.vue) was created for the table display in the Element UI.

## Results on the web
- To see the Native Vue 3 solution go to [my test platform](https://luxus.emisdb.ru/hic/stand)
- To see the same solution in Element UI go [here](https://luxus.emisdb.ru/hic/search)
- API endpoint is also [accessible](https://luxus.emisdb.ru/api/property-data)
- Credentials 
  - Email Address: test@test.org
  - password: testtest
- You can jump to these pages from the sidebar menu: Search, Element Search

