#include <iostream>
using namespace std;

void votaciones();

int main(int argc, char** argv) {
	
		int i = 0;
		int opcion = 0;
		
		while( i != 1 ){
		
		cout<<"1-Numero Primos"<<endl;
		cout<<"2-Votaciones"<<endl;
		cout<<"3-Llamadas"<<endl;
		cout<<"4-Fibonacci"<<endl;
		cout<<"0-EXIT"<<endl;
		cout<<"¿Que opcion quiere Entrar?"<<endl;	
		cin>>opcion;
		
		switch(opcion){
				case 1:
					
					break;
				case 2:
					votaciones();
					break;
				case 3:
					
					break;
				case 4:
					
					break;
				case 0:
					cout<<"ADIOS";
					return 0;
					break;
			}
			
		}
		
}

void votaciones()
{
		int voto = 0 , i = 0, j = 0, ganador = 0, cand = 0, votos[6] = {0,0,0,0,0,0} , personas = 0 , total_votos = 0;
	  
	double porcentaje_ganador = 0;
	
	cout<<"“este algoritmo servira para resolver la cantidad de votos de cada uno de los candidatos, y tambien cual fue el candidato ganador, los votos que obtuvo y el total de los votos que obtuvo"<<endl;
	
	while(i != 1){
		
		cout<<"¿por quién vas a votar, elige un numero del 1 al 6? ";
		cin>>voto;
		
		switch(voto){
			case 1 : votos[0] += 1;
				break;
			case 2 : votos[1] += 1;
				break;
			case 3 : votos[2] += 1;
				break;
			case 4 : votos[3] += 1;
				break;
			case 5 : votos[4] += 1;
				break;
			case 6 : votos[5] += 1;
				break;
			default:
					if( voto == 0 ){
						i = 1;
					}else{
						cout<<"Elige otro numero"<<endl;
					}
				break;
		}
	}
	/*
	for( int x = 0 ; x < 6 ; x++ )
	{
		cout<<"Cantidado "<<(x+1)<<" Resultado: "<<votos[x]<<endl;
	}*/
	int votos_temp = 0;
	/*Aqui esta el error,*/
	/*compara ganador con los votos, en la primera vuela ganador siempre sera igual a la posicion y al coomprar siempre se comparan las pocisiones con los votos */
	/*por ejemplo 5 < 50000 si todos los votos exceden los 6 el ultimo candidato siempre sera el ganador*/
	for( i = 0 ; i < 6 ; i++ )
	{
		if( i == 0 ){
			ganador = i;
			votos_temp = votos[i];
		}else{
			if( votos_temp < votos[i] ){
				ganador = i;
				votos_temp = votos[i];
			}
		} 
		// += es igual a total_votos = total_votos + votos[i];
		total_votos += votos[i];
	}
	
	porcentaje_ganador = ( votos[ganador] * 100 ) / total_votos;
	
	cout<<"Cantidad de votos conseguidos:"<<endl;
	
	for( i = 0 ; i < 6 ; i++)
	{
		cand = i + 1;
		cout<<"Candidato"<< cand << " obtuvo: " << votos[i]<<endl;
	}

	
	cout<<" El candidato que tuvo mas votos es el # " << (ganador+1) << " con " << votos[ganador] << " y gano con un porcentaje de " << porcentaje_ganador;
	
	
}
