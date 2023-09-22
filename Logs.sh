clear
opcion=0
echo "Bienvenido al registro logs"
while [ "$opcion" -ne 4 ]
do
echo "Estas son sus opciones"
echo "1.Ver Logins"
echo "2.Ver actividades"
echo "3.Ver logins y actividades de un usuario específico"
echo "4.salir"
read opcion
if [ "$opcion" -eq 1 ]; then
clear
last -F
elif [ "$opcion" -eq 2 ]; then
clear
w what
elif [ "$opcion" -eq 3 ]; then
clear
echo "Escriba el usuario del cual desea saber"
read user
if id "$user" &>/dev/null; then
echo "Información sobre el usuario $user"
w what "$user"
else
  echo "El usuario $user no existe"
fi
fi
done
