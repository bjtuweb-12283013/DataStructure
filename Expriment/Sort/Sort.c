#include <stdio.h>    
#define MAX_LENGTH_INSERT_SORT 7
#define MAXSIZE 10000   

typedef struct
{
	int r[MAXSIZE+1]; 
	int length;    
}SqList;

void swap(SqList *L,int i,int j) 
{
	int temp=L->r[i]; 
	L->r[i]=L->r[j]; 
	L->r[j]=temp; 
}

void print(SqList L)
{
	int i;
	for(i=1;i<L.length;i++)
		printf("%d,",L.r[i]);
	printf("%d",L.r[i]);
	printf("\n");
}


void BubbleSort(SqList *L)
{ 
	int i,j;
	for(i=1;i<L->length;i++)
		for(j=L->length-1;j>=i;j--) 
			if(L->r[j]>L->r[j+1]) 
				swap(L,j,j+1);
}

void SelectSort(SqList *L)
{
	int i,j,min;
	for(i=1;i<L->length;i++)
	{ 
		min = i;            
		for (j = i+1;j<=L->length;j++)
		{
			if (L->r[min]>L->r[j]) 
			min = j;       
		}
		if(i!=min)           
		swap(L,i,min);
	}
}

void InsertSort(SqList *L)
{ 
	int i,j;
	for(i=2;i<=L->length;i++)
	{
		if (L->r[i]<L->r[i-1]) 
		{
			L->r[0]=L->r[i];
			for(j=i-1;L->r[j]>L->r[0];j--)
				L->r[j+1]=L->r[j];
			L->r[j+1]=L->r[0];
		}
	}
}

void HeapAdjust(SqList *L,int s,int m)
{ 
	int temp,j;
	temp=L->r[s];
	for(j=2*s;j<=m;j*=2)
	{
		if(j<m && L->r[j]<L->r[j+1])
			++j; 
		if(temp>=L->r[j])
			break; 
		L->r[s]=L->r[j];
		s=j;
	}
	L->r[s]=temp; 
}

void HeapSort(SqList *L)
{
	int i;
	for(i=L->length/2;i>0;i--)
	HeapAdjust(L,i,L->length);
	for(i=L->length;i>1;i--)
	{   
		swap(L,1,i); 
		HeapAdjust(L,1,i-1); 
	}
}

void Merge(int SR[],int TR[],int i,int m,int n)
{
	int j,k,l;
	for(j=m+1,k=i;i<=m && j<=n;k++)
	{
		if (SR[i]<SR[j])
			TR[k]=SR[i++];
		else
			TR[k]=SR[j++];
	}
	if(i<=m)
	{
		for(l=0;l<=m-i;l++)
			TR[k+l]=SR[i+l];
	}
	if(j<=n)
	{
		for(l=0;l<=n-j;l++)
			TR[k+l]=SR[j+l];
	}
}

void MSort(int SR[],int TR1[],int s, int t)
{
	int m;
	int TR2[MAXSIZE+1];
	if(s==t)
		TR1[s]=SR[s];
	else
	{ 
		m=(s+t)/2;        
		MSort(SR,TR2,s,m);    
		MSort(SR,TR2,m+1,t);
		Merge(TR2,TR1,s,m,t);
	}
}

void MergeSort(SqList *L)
{ 
	MSort(L->r,L->r,1,L->length);
}

int Partition(SqList *L,int low,int high)
{ 
	int pivotkey;
	pivotkey=L->r[low]; 
	while(low<high)
	{ 
		while(low<high&&L->r[high]>=pivotkey)
			high--;
		swap(L,low,high);
		while(low<high&&L->r[low]<=pivotkey)
			low++;
		swap(L,low,high);
	}
	return low; 
}

void QSort(SqList *L,int low,int high)
{ 
	int pivot;
	if(low<high)
	{
		pivot=Partition(L,low,high); 
		QSort(L,low,pivot-1);
		QSort(L,pivot+1,high);
	}
}

void QuickSort(SqList *L)
{ 
	QSort(L,1,L->length);
}

#define N 9
int main()
{
	int i;
	int d[N]={50,10,90,30,70,40,80,60,20};
	SqList l0,l1,l2,l3,l4,l5,l6,l7,l8,l9,l10;
	for(i=0;i<N;i++)
		l0.r[i+1]=d[i];
	l0.length=N;
	l1=l2=l3=l4=l5=l6=l7=l8=l9=l10=l0;
	printf("Before Sort:\n");
	print(l0);

	printf("BubbleSort:\n");
	BubbleSort(&l1);
	print(l1);

	printf("SelectSort:\n");
	SelectSort(&l3);
	print(l3);

	printf("InsertSort:\n");
	InsertSort(&l4);
	print(l4);

	printf("HeapSort:\n");
	HeapSort(&l6);
	print(l6);

	printf("MergeSort:\n");
	MergeSort(&l7);
	print(l7);

	printf("QuickSort:\n");
	QuickSort(&l9);
	print(l9);

	return 0;
} 