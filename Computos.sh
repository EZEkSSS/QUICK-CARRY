
menu(){
	echo "1. Gestion de Usuarios"
	echo "2. Gestion de grupos"
	echo "3. Crear respaldo"
	echo "4. Reiniciar servidor"
	echo "5. Salir"
}

menuUsuarios(){
	echo "Gestion de usuarios"
	echo "1. Alta usuario"
	echo "2. Baja usuario"
	echo "3. Modificar usuario"
	echo "4. Asignar grupo a un usuario"
	echo "5. Volver"
}

altaUsuario(){
	read -p "Ingrese el nombre del nuevo usuario: " nuevoUsuario
	sudo useradd $nuevoUsuario
	sudo passwd $nuevoUsuario
	echo "$nuevoUsuario ingresado correctamente"
}

bajaUsuario(){
	read -p "Ingrese el nombre del usuario a eliminar: " eliminarUsuario
	sudo userdel $eliminarUsuario
	echo "$eliminarUsuario eliminado correctamente"
}

modificarUsuario(){
	read -p "Ingrese el nombre del usuario a modificar: " nombreUsuario
	read -p "Ingrese el nuevo nombre para el usuario: "  nuevoNombre
	sudo usermod -l $nuevoNombre $nombreUsuario
	echo "$nombreUsuario ahora se llama $nuevoNombre"
}

asignarGrupo(){
	read -p "Ingrese el nombre del usuario: " nombreUsuario
	read -p "Ingrese el nombre del grupo: " nombreGrupo
	sudo usermod -aG $nombreGrupo $nombreUsuario
	echo "El usuario $nombreUsuario ha sido ingresado al grupo $nombreGrupo correctamente"
}

menuGrupos(){
	echo "Gestion de grupos"
	echo "1. Nuevo grupo"
	echo "2. Eliminar grupo"
	echo "3. Modificar grupo"
	echo "4. Volver"
}

nuevoGrupo(){
	read -p "Ingrese el nombre del nuevo grupo: " nuevoGrupo
	sudo groupadd $nuevoGrupo
	echo "$nuevoGrupo creado correctamente"
}

eliminarGrupo(){
	read -p "Ingrese el nombre del grupo que desea eliminar: " eliminarGrupo
	sudo groupdel $eliminarGrupo
	echo "$eliminarGrupo eliminado correctamente"
}

modificarGrupo(){
	read -p "Ingrese el nombre del grupo que desea modificar: " nombreGrupo
	read -p "Ingrese el nuevo nombre para el grupo: " nuevoNombre
	sudo groupmod -n $nuevoNombre $nombreGrupo
	echo "$nombreGrupo ahora se llama $nuevoNombre"
}

gestion=0
while [ $gestion -ne 5 ]
do
	opcion=0
	menu
	read -p "Ingrese una opcion: " gestion
	case $gestion in
		1)	
			while [ $opcion -ne 5 ]
			do
				menuUsuarios
				read -p "Seleccione una opcion: " opcion 
				case $opcion in
					1)altaUsuario;;
					2)bajaUsuario;;
					3)modificarUsuario;;
					4)asignarGrupo;;
				esac
			done
			;;
		2)
			while [ $opcion -ne 4 ]
			do#!/bin/bash/

				menuGrupos
				read -p "Seleccione una opcion: " opcion
				case $opcion in
					1)nuevoGrupo;;
					2)eliminarGrupo;;
					3)modificarGrupo;;
				esac
			done
			;;
		3)sh respaldo.sh;;
		4)reboot;;
		5)echo "Adios!";;
	esac
done
