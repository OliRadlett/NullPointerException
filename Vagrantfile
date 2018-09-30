# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://vagrantcloud.com/search.
  config.vm.box = "ubuntu/trusty64"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  # NOTE: This will enable public access to the opened port
  # config.vm.network "forwarded_port", guest: 80, host: 8080

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine and only allow access
  # via 127.0.0.1 to disable public access
  # config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  config.vm.network "private_network", ip: "5.5.5.5"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network "public_network"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  config.vm.synced_folder "./", "/var/www/html"

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  #config.vm.provider "virtualbox" do |vb|
    # Display the VirtualBox GUI when booting the machine
  #  vb.gui = true
  #
  #   # Customize the amount of memory on the VM:
  #   vb.memory = "1024"
  #end
  #
  # View the documentation for the provider you are using for more
  # information on available options.

  class Username
    def to_s
      print "Please enter your GitHub credentials\n"
      print "Username: "
      STDIN.gets.chomp
    end
  end

   class Password
     def to_s
       begin
       system 'stty -echo'
       print "Password: "
       pass = URI.escape(STDIN.gets.chomp)
       ensure
       system 'stty echo'
       end
       pass
     end
   end

  # Enable provisioning with a shell script. Additional provisioners such as
  # Puppet, Chef, Ansible, Salt, and Docker are also available. Please see the
  # documentation for more information about their specific syntax and use.
  config.vm.provision "shell", env: {"USERNAME" => Username.new, "PASSWORD" => Password.new},  inline: <<-SHELL
    # Install packages
    sudo apt-get update
    sudo apt-get install -y apache2
    sudo apt-get install -y git
    sudo add-apt-repository -y ppa:ondrej/php
    sudo apt-get update
    sudo apt-get install -y php7.1
    sudo apt-get install -y php7.1-mysqli
    sudo apt-get install -y php7.1-xdebug
    sudo apt-get update
    sudo apt-get upgrade -y
    sudo apt-get autoremove -y
    # Show PHP errors and setup xdebug
    sudo sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php/7.1/cli/php.ini
    sudo sed -i "s/display_errors = .*/display_errors = On/" /etc/php/7.1/cli/php.ini
    sudo sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php/7.1/apache2/php.ini
    sudo sed -i "s/display_errors = .*/display_errors = On/" /etc/php/7.1/apache2/php.ini
    sudo sed -i "s/display_errors = .*/display_errors = On/" /etc/php/7.1/apache2/php.ini
    # Enable MySQLi
    phpenmod mysqli
    # Restart apache to apply changes to ini file
    sudo service apache2 restart
    # Delete auto-generated index.html file
    sudo rm -f -- /var/www/html/index.html
    # Delete old connection details
    sudo rm -f -r -- /var/www/private/
    # Download connection details from git repo
    git clone https://$USERNAME:$PASSWORD@github.com/$USERNAME/NullPointerException-private /var/www/private/
  SHELL
end
