# Custom Nginx Configuration for Azure App Services to Access Web Pages without .HTML Extension

This guide outlines the steps required to configure a custom `nginx.conf` file for your Azure App Service, enabling URL redirection and ensuring that changes persist across app restarts.

## Steps

### Step 1: Create `nginx.conf`
1. In your project root directory, create a new file named `nginx.conf`.
2. Using the SSH Linux command line ([Access here](https://yourappname.scm.azurewebsites.net/newui/webssh)), copy the contents of the default Nginx configuration file located at `/etc/nginx/sites-available/default`.
3. Paste the copied contents into the `nginx.conf` file in your project directory.

### Step 2: Update the Configuration File
Add the following lines to the `nginx.conf` file to handle URL redirection:

```nginx
location / {
    if ($request_uri ~ ^/(.*)\.html(\?|$)) {
        return 302 /$1;
    }
    try_files $uri $uri.html $uri/ =404;
}
```

### Step 3: Create `startup.sh`
1. In your project root directory, create a new file named `startup.sh`.
2. Add the following content to the file:

```bash
#!/bin/bash

# Copy custom nginx.conf to Nginx directory
cp /home/site/wwwroot/nginx.conf /etc/nginx/sites-available/default

# Reload Nginx with custom config
service nginx reload
```

### Step 4: Add Startup Command in Azure Portal
1. Navigate to your Azure App Service in the Azure Portal.
2. In the **Configuration** section, add the following startup command to point to the `startup.sh` file:

```bash
./startup.sh
```
![Alt Text](https://raw.githubusercontent.com/azureossdemo/php-html-ext/refs/heads/main/AppServiceConfiguration.png)

### Why These Steps Are Necessary
1. **Store Proper Config File:** Ensure the `nginx.conf` file is properly stored in your project.
2. **Modify Default Config:** Replace the Azure default Nginx configuration with your custom configuration.
3. **Enable URL Redirection:** Redirect URLs like `/dl` to `/dl.html`.
4. **Apply Changes on Restart:** Persist changes to the Nginx configuration across restarts by running the `startup.sh` script.

### Additional Notes
- The Nginx configuration directory in Azure App Services is not persistent, so it resets to the default configuration after each restart. This script ensures your changes are reapplied automatically.
- The provided `nginx.conf` and `startup.sh` files should be added to your project repository to facilitate configuration through deployments.
- These configuration is required for the Nginx based server like Azure
- If you are running your application on Apache server, you can achieve same results with .htaccess file configuration that is already added to repo

## Keywords
Azure App Services, Nginx configuration, custom Nginx, Azure startup script, URL redirection, Nginx reload, custom web server, Azure configuration file, Linux command line, Azure deployment.

